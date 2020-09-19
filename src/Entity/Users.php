<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 */
class Users implements UserInterface,\Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $password;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
    /**
     *Returns the roles granted to the user.
    *
    *public function getRoles()
    *      {
    *
    *      return array('ROLE_USER');
    *
    *      }
    *  @return (Role|string)[] The user roles
    *
    */
        public function getRoles(){

            return ['ROLE_ADMIN'];
        }

    /**
    *
    *
    *  @return string|null The salt
    *
    */
        public function getSalt(){

            return null;
        }

        /**
         *
         */

         public function eraseCredentials() {

         }

         /**
          * String representation of object
          * @link http://php.net/manuel/en/serializable.php
          * @return string the string representation of the object or null
          * @since 5.1.0
          */

          public function serialize(){
            return serialize([
                $this->id,
                $this->username,
                $this->password
            ]);
          }

          /**
          * String representation of object
          * @link http://php.net/manuel/en/serializable.unserialize.php
          * @param string serialized <p>
          * the string representation of the object or null
          * </p>
          * @return vold
          * @since 5.1.0
          */

          public function unserialize($serialize){
            list (
                $this->id,
                $this->username,
                $this->password
            ) = unserialize($serialize, ['allowed_classes' => false]);
          }
}
