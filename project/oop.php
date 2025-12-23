
<?php
   
   class Humen{
    public string $name;
    public float $height;
    public float $wieght=10;
    public string $gender;

   public function walk(){
  echo "wwalking";
    }

    public function eating(float $add){
   $this->wieght += $add;
    }

       public function __construct($nom){
       $this->name = $nom;
    }
   }

   $jouer=new Humen("nouh");
   $jouer->name="nouh";
  echo $jouer->name;
   $jouer->walk();
?>

