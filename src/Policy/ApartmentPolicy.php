<?php

declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Apartment;
use Authorization\IdentityInterface;

/**
 * Apartment policy
 */
class ApartmentPolicy
{
    /**
     * Check if $user can add Apartment
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Apartment $apartment
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Apartment $apartment)
    {
        return $user->user_type == 'admin';
    }

    /**
     * Check if $user can edit Apartment
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Apartment $apartment
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Apartment $apartment)
    {
        return $user->user_type == 'admin';
    }
    /**
     * Check if $user can index Apartment
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Apartment $apartment
     * @return bool
     */
    public function canIndex(IdentityInterface $identity, Apartment $resource)
    {
        return $identity->user_type == 'admin';
    }
    /**
     * Check if $user can delete Apartment
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Apartment $apartment
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Apartment $apartment)
    {
        return $user->user_type == 'admin';
    }

    /**
     * Check if $user can view Apartment
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Apartment $apartment
     * @return bool
     */
    public function canView(IdentityInterface $user, Apartment $apartment)
    {
        return $user->user_type == 'admin';
    }
}
