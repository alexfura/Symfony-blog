<?php


namespace App\Security;


use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class UserVoter extends Voter
{
    // access attributes for user
    const EDIT = 'user_edit';

    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, [self::EDIT])) {
            return false;
        }
        
        if (!$subject instanceof User) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();


        if(!$user instanceof User)
        {
            return false;
        }

        if(!$subject instanceof User)
        {
            return false;
        }

        switch ($attribute)
        {
            case self::EDIT:
                return $this->canEdit($subject, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    protected function canEdit(User $user, User $current_user)
    {
        return $user === $current_user;
    }
}