<?php

namespace App\Entity;

class RestaurantSearch {



   private ?string $name = null;


   public function getName(): ?string
   {
       return $this->name;
   }

   public function setName(string $name): self
   {
       $this->name = $name;

       return $this;
   }

}