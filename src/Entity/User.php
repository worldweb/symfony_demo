<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements AdvancedUserInterface, \Serializable {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=175, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(name="is_active", type="boolean",length=1)
     */
    private $isActive;
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Post", mappedBy="user_id")
     */
    private $posts;
    /**
     *@ORM\Column(type="string")
     */
    private $role;
    public function __construct() {
        $this->isActive = true;
        $this->role = 'ROLE_USER';
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid('', true));
    }

    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getSalt() {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function getPassword() {
        return $this->password;
    }
    
    public function setPassword($password) {
        $this->password = $password;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getRoles() {
        return array('ROLE_USER');
    }
    
    public function setRoles() {
        return $this->getRoles();
    }

    public function getPlainPassword() {
        return $this->plainPassword;
    }

    public function setPlainPassword($password) {
        $this->plainPassword = $password;
    }

    public function eraseCredentials() {
        
    }

    /**
     * @return Collection|Post[]
     */
    public function getPosts(): Post {
        return $this->posts;
    }

    public function addPost(Post $post): self {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
            $post->setUserId($this);
        }

        return $this;
    }

    public function removePost(Post $post): self {
        if ($this->posts->contains($post)) {
            $this->posts->removeElement($post);
            // set the owning side to null (unless already changed)
            if ($post->getUserId() === $this) {
                $post->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * checks whether the user's account has expired;
     * @return boolean
     */
    public function isAccountNonExpired() {
        return true;
    }

    /**
     * checks whether the user is locked
     * @return boolean
     */
    public function isAccountNonLocked() {
        return true;
    }

    /**
     * checks whether the user's credentials (password) has expired
     * @return boolean
     */
    public function isCredentialsNonExpired() {
        return true;
    }

    /**
     * checks whether the user is enabled.
     * @return type
     */
    public function isEnabled() {
        return $this->isActive;
    }

    /** @see \Serializable::serialize() */
    public function serialize() {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
                // see section on salt below
                // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized) {
        list (
                $this->id,
                $this->username,
                $this->password,
                // see section on salt below
                // $this->salt
                ) = unserialize($serialized);
    }

}
