<?php

declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Inspection;
use Authorization\IdentityInterface;

/**
 * Inspection policy
 */
class InspectionPolicy
{
    /**
     * Check if $user can add Inspection
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Inspection $inspection
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Inspection $inspection)
    {
        if (($user->user_type == 'admin')) {
            return true;
        } else if ($this->isContractor($user, $inspection)) {
            return false;
        } else {
            return false;
        }
    }

    /**
     * Check if $user can edit Inspection
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Inspection $inspection
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Inspection $inspection)
    {
        if (($user->user_type == 'admin')) {
            return true;
        } else if ($this->isContractor($user, $inspection)&& $inspection->inspection_status != 'Finished') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check if $user can delete Inspection
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Inspection $inspection
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Inspection $inspection)
    {
        if (($user->user_type == 'admin')) {
            return true;
        } else if ($this->isContractor($user, $inspection)) {
            return false;
        } else {
            return false;
        }
    }

    public function canReject(IdentityInterface $user, Inspection $inspection)
    {
        if (($user->user_type == 'admin')) {
            return true;
        } else if ($this->isContractor($user, $inspection)) {
            return false;
        } else {
            return false;
        }
    }

    public function canFinish(IdentityInterface $user, Inspection $inspection)
    {
        if (($user->user_type == 'admin')) {
            return true;
        } else if ($this->isContractor($user, $inspection)) {
            return false;
        } else {
            return false;
        }
    }
    /**
     * Check if $user can view Inspection
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Inspection $inspection
     * @return bool
     */
    public function canView(IdentityInterface $user, Inspection $inspection)
    {
        if (($user->user_type == 'admin')) {
            return true;
        } else if ($this->isContractor($user, $inspection)) {
            return true;
        } else if ($inspection->has('user') == False){
            return true;
        }else{
            return false;
        }
    }


    protected function isContractor(IdentityInterface $user, Inspection $inspection)
    {
        return $inspection->user_id === $user->user_id;
    }

    public function accept(IdentityInterface $user, Inspection $inspection)
    {
        return true;
    }
}
