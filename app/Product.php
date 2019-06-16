<?php

namespace App;

use App\Constants\Common;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Helpers\Utils;
use App\Constants\ProductStatus;
use App\Constants\ProductType;
use App\Constants\Status;

class Product extends Model
{
    //
    public $timestamps = false;
    protected $fillable = [];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = Common::PRODUCTS;
    
    public function getFirstImage($thumb = '') {
        $image_product = ImageProduct::select('image','medium','small')->where('product_id', $this->id)->where('is_main', 1)->first();
        if($image_product) {
            if(!Utils::blank($thumb)) {
                return Utils::getImageLink($image_product->$thumb);
            }
            return Utils::getImageLink($image_product->image);
        }
        
        $image_product = ImageProduct::select('image','medium','small')->where('product_id', $this->id)->first();
        if($image_product) {
            if(!Utils::blank($thumb)) {
                return Utils::getImageLink($image_product->$thumb);
            }
            return Utils::getImageLink($image_product->image, $image_product->$thumb);
        }
        return Utils::getImageLink(Common::NO_IMAGE_FOUND);
    }
    
    public function getAllImage($id = '') {
        $output = [];
        $image_product = ImageProduct::select('id', 'image', 'is_main')->where('product_id', $this->id)->get();
//         foreach($image_product as $image) {
//             $image_url = Utils::getImageLink($image->image);
//             $output[$image->id] = $image_url;
//         }
        return $image_product;
    }
    
    public function getImageDetails() {
        $image_product = ImageProduct::where('product_id', $this->id)->get();
        return $image_product;
    }
    
    public function getCategoryName() {
        $category = Category::select('name')->where('id', $this->category_id)->first();
        return $category ? $category->name : '';
    }
    
    public function getCategoryLink() {
        $category = Category::select('name_url')->where('id', $this->category_id)->first();
        return $category ? route('category', ['slug' => $category->name_url]) : '';
    }
    
    public function getVendorName() {
        $vendor = Vendor::select('name')->where('id', $this->vendor_id)->first();
        return $vendor ? $vendor->name : '';
    }
    
    
    public function getServices() {
        $details = ProductDetails::select(
                            'product_detail_groups.id AS group_id', 
                            'product_detail_groups.name AS group_name', 
                            DB::raw('GROUP_CONCAT(product_details.name ORDER BY product_details.id) AS service_names'), 
                            DB::raw('GROUP_CONCAT(product_details.price ORDER BY product_details.id) AS service_prices')
                        )
                        ->join('product_detail_groups', 'product_detail_groups.id', '=', 'product_details.product_detail_group_id')
                        ->where('product_details.product_id', $this->id)
                        ->groupBy('product_detail_groups.id', 'product_detail_groups.name')
                        ->get();
        
        $html = '';
        $table = view('auth.products.details', ['details' => $details])->render();
        $html .= $table;
        
        return $html;
    }
    
    public function getDiscount() {
        if($this->price > 0 && $this->discount > 0) {
            return '<div class="sale-flash"><div class="before"></div>-' . $this->discount . '%</div>';
        }
        return '';
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getPrice($format = true) {
        if($this->price === 0) {
            return trans('shop.price_contact');
        }
        
        if($this->price > 0) {
            if($format) {
                return Utils::formatCurrency($this->price);
            }
        }
        
        return $this->price;
    }
    
    public function getPriceDiscount($format = true) {
        if($this->discount) {
            if($format) {
                return Utils::formatCurrency(($this->price - ($this->price * ($this->discount / 100))));
            }
            return $this->price - ($this->price * ($this->discount / 100));
        }
    }
    
    public function getSEOKeywords() {
        return !Utils::blank($this->seo_keywords) ? $this->seo_keywords : $this->name;
    }
    
    public function getSEODescription() {
        $seoDescription = !Utils::blank($this->seo_description) ? $this->seo_description : $this->summary;
        if(Utils::blank($seoDescription)) {
            $seoDescription = $this->name; 
        }
        return $seoDescription;
    }
    
    public function getSummary() {
        return $this->summary;
    }
    
    public function getDescription() {
        return $this->description;
    }
    
    public function getLink() {
        return route('product_details',['slug' => $this->name_url]);
    }
    
    public function getStatus() {
        return $this->status;
    }
    
    public function getStatusName() {
        $status = trans('auth.status.out_of_stock');
        if($this->avail_flg == ProductStatus::AVAILABLE) {
            $status = trans('auth.status.available');
        }
        return $status;
    }
    
    public function getImageWidth() {
        return '280';
    }
    
    public function getImageHeight() {
        return '280';
    }
    
    public function scopeActive($query) {
        return $query->where('status', Status::ACTIVE);
    }
    
    public function scopeIsNew($query) {
        return $query->where('is_new', ProductType::IS_NEW);
    }
    
    public function scopeIsPopular($query) {
        return $query->where('is_popular', ProductType::IS_POPULAR);
    }
    
    public function scopeIsBestSelling($query) {
        return $query->where('is_best_selling', ProductType::IS_BEST_SELLING);
    }
    
    public function getProductDetails() {
        $productDetails = ProductDetails::select(
                            'product_detail_groups.id AS group_id',
                            'product_detail_groups.name AS group_name',
                            DB::raw('GROUP_CONCAT(product_details.id ORDER BY product_details.id) AS detail_id'), 
                            DB::raw('GROUP_CONCAT(product_details.name) AS detail_name'), 
                            DB::raw('GROUP_CONCAT(product_details.price) AS detail_price')
                          )
                          ->leftJoin('product_detail_groups', function($join) {
                              $join->on('product_detail_groups.id', '=', 'product_details.product_detail_group_id');
                          })
                          ->where('product_details.product_id', $this->id)
                          ->groupBy('product_detail_groups.id', 'product_detail_groups.name')
                          ->orderBy('product_detail_groups.id')->get();
        
        
        return $productDetails;
        
    }
    
    public function getRelatedProducts() {
        $products = Product::where('id', '!=', $this->id)->active()->get();
        return $products;
    }
}
