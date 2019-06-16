<?php

namespace App;

use App\Constants\Common;
use App\Constants\Status;
use App\Helpers\Utils;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    public $timestamps = false;
    protected $fillable = [];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = Common::POSTS;
    
    public function getImage() {
        if(!Utils::blank($this->photo)) {
            return Utils::getImageLink($this->photo);
        }
        return Utils::getImageLink(Common::NO_IMAGE_FOUND);
    }
    
    public function getTitle() {
        return $this->name;
    }
    
    public function getSummary() {
        return $this->description;
    }
    
    public function getSEOKeywords() {
        return $this->seo_keywords;
    }
    
    public function getSEODescription() {
        return $this->seo_description;
    }
    
    public function getCreatedAt() {
        return Utils::formatDate($this->created_at);
    }
    
    public function getPhoto() {
        if(!Utils::blank($this->photo)) {
            return Utils::getImageLink($this->photo);
        }
        return Utils::getImageLink(Common::NO_IMAGE_FOUND);
    }
    
    public function getContent() {
        return $this->content;
    }
    
    public function getLink() {
        return route('postDetails', ['slug1' => $this->name_url]);
    }
    
    public function scopeActive($query) {
        return $query->where('status', Status::ACTIVE);
    }
}
