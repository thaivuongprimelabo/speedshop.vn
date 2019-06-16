<?php

namespace App;

use App\Constants\Common;
use App\Constants\Status;
use Illuminate\Database\Eloquent\Model;

class PostGroups extends Model
{
    //
    public $timestamps = false;
    protected $fillable = [];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table = Common::POST_GROUPS;
    
    public function getLink() {
        return route('postgroups', ['slug' => $this->name_url]);
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function scopeActive($query) {
        return $query->where('status', Status::ACTIVE);
    }
    
    public function getChildGroup() {
        $postGroups = PostGroups::select('id', 'name', 'name_url')->active()->where('parent_id', $this->id)->get();
        return $postGroups;
    }
    
    public function getParentName() {
        $postGroups = PostGroups::select('name')->active()->where('id', $this->parent_id)->first();
        return $postGroups ? $postGroups->name : '--';
    }
}
