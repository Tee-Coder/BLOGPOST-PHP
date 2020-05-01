<?php
class Blog {
  
  public $id  = 0;
  public $title = '';
  public $content  = '';
  
  function __construct ( $id = 0, $title = 'No identified title', $content = 'No content' )
  {
    if ( is_integer( $id ) && !empty( $id ) )
      $this->id = $id;
    if ( is_string( $title ) && !empty( $title ) )
      $this->title = $title;
    if ( is_string( $content ) && !empty( $content ) )
      $this->content = $content;
  }
  
  public function output ( $echo = TRUE )
  {
    $output = '';
    ob_start(); 
    ?>
      <ul>
        
        <li>id: <?php echo $this->id; ?></li>
        
        <li>title: <?php echo $this->title; ?></li>
        
        <li>content: <?php echo $this->content; ?></li>
      </ul>
    <?php 
    $output = ob_get_clean(); 
    if ( $echo === TRUE ) echo $output; // Output, if our argument tells us to.
    return $output; // Return the string.
  }
}