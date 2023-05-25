<?php

declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Email;
use Authorization\IdentityInterface;

/**
 * email policy
 */
class emailPolicy
{
    /**
     * Check if $user can add email
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Email $email
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Email $Email)
    {
        return true;
    }

    /**
     * Check if $user can index email
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Email $email
     * @return bool
     */
    public function canIndex(IdentityInterface $identity, Email $resource)
    {
        return $identity->user_type == 'admin';
    }
    /**
     * Check if $user can edit email
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\email $email
     * @return bool
     */
    public function canEdit(IdentityInterface $user, email $email)
    {
        return $user->user_type == 'admin';
    }

    /**
     * Check if $user can delete email
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\email $email
     * @return bool
     */
    public function canDelete(IdentityInterface $user, email $email)
    {
        return $user->user_type == 'admin';
    }

    /**
     * Check if $user can view email
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\email $email
     * @return bool
     */
    public function canView(IdentityInterface $user, email $email)
    {
        return $user->user_type == 'admin';
    }

    /**
     * Check if $user can delete email
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\email $email
     * @return bool
     */
    public function canAdminadd(IdentityInterface $user, email $email)
    {
        return $user->user_type == 'admin';
    }

    public function canReject(IdentityInterface $user, email $email)
    {
      return true;
    }

    public function canContractorask(IdentityInterface $user, email $email)
    {
        return true;
    }

    public function canRespond(IdentityInterface $user, email $email)
    {
        return true;
    }

}
