<?php

declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Image;
use Authorization\IdentityInterface;

class imagePolicy
{
    public function canIndex(IdentityInterface $identity, Image $resource)
    {
        // return $identity->user_type == 'admin';
        return false;
    }

    public function canAdd(IdentityInterface $user, Image $resource)
    {
        // if(($user->user_type == 'admin')){
        //     return true;
        // }else if($this->isContractor($user, $resource)){
        //     return false;
        // }else{
        //     return false;
        // }
        return false;
    }

    /**
     * Check if $user can edit Inspection
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Image $resource
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Image $resource)
    {
        // if(($user->user_type == 'admin')){
        //     return true;
        // }else if($this->isContractor($user, $resource)){
        //     return true;
        // }else{
        //     return false;
        // }
        return false;
    }

    /**
     * Check if $user can delete Inspection
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Image $resource
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Image $resource)
    {
        // if(($user->user_type == 'admin')){
        //     return true;
        // }else if($this->isContractor($user, $resource)){
        //     return false;
        // }else{
        //     return false;
        // }
        return false;
    }

    /**
     * Check if $user can view Inspection
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Image $resource
     * @return bool
     */
    public function canView(IdentityInterface $user, Image $resource)
    {
        // if(($user->user_type == 'admin')){
        //     return true;
        // }else if($this->isContractor($user, $resource)){
        //     return true;
        // }else{
        //     return false;
        // }
        return false;
    }
}
