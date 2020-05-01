<?php
// Class declaration.
class Blog {
  /**
   * Properties (with default values.)
   */
  // PUBLIC means it can be overwritten OUTSIDE of what's in the class methods.
  public $id  = 0;
  public $title = '';
  public $content  = '';
  /**
   * Methods.
   */
  // __construct executes each time we make a new instance of this class (a new object.)
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
    ob_start(); // Begins an output buffer.
    ?>
      <ul>
        
        <li>id: <?php echo $this->id; ?></li>
        
        <li>title: <?php echo $this->title; ?></li>
        
        <li>content: <?php echo $this->content; ?></li>
      </ul>
    <?php // ob_get_clean() clears the output buffer, and returns what the string was.
    $output = ob_get_clean(); // We now have the buffered (echo'd) string contents saved in a variable.
    if ( $echo === TRUE ) echo $output; // Output, if our argument tells us to.
    return $output; // Return the string.
  }
}