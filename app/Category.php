<?php

namespace App;

use App\Constants\Common;
use App\Constants\ProductType;
use App\Constants\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Constants\ProductStatus;

class Category extends Model
{
    //
    public $timestamps = false;
    protected $fillable = [];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = Common::CATEGORIES;
    
    public function getParentName() {
        $category = Category::select('name')->where('id', $this->parent_id)->first();
        return $category ? $category->name : '--';
    }
    
    public function getChildCategory() {
        $categories = Category::select('id', 'name', 'name_url', 'parent_id')->where('parent_id', $this->id)->get();
        return $categories;
    }
    
    public function getProductInCategory($type = '', $get = true, $limit_product_show = Common::LIMIT_PRODUCT_SHOW_TAB) {
        
        if(!$get) {
            return [];
        }
        
        $wheres = [
            ['status', '=', Status::ACTIVE]
        ];
        
        switch($type) {
            case ProductType::IS_NEW:
                array_push($wheres, ['is_new', '=', $type]);
                break;
                
            case ProductType::IS_BEST_SELLING:
                array_push($wheres, ['is_best_selling', '=', $type]);
                break;
                
            case ProductType::IS_POPULAR:
                array_push($wheres, ['is_popular', '=', $type]);
                break;
            default:
                
                break;
        }
        
        $whereIn = 'category_id IN (SELECT id FROM categories c1 WHERE c1.parent_parent_id = ' . $this->id . ') OR category_id = ' . $this->id;
        
        $products = Product::where($wheres)->whereRaw($whereIn)->orderBy('created_at', 'DESC')->limit($limit_product_show)->get();
        return $products;
    }
    
    public function getLink() {
        return route('category',['slug' => $this->name_url]);
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function scopeActive($query) {
        return $query->where('status', Status::ACTIVE);
    }
}
