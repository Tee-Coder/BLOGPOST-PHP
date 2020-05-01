<?php
include_once dirname( __FILE__ ) . '/Blogpost.Class.php';
class Blogs
{
  // Properties.
  private $theBlogs = array();

  // Methods.

  function __construct ( $jsonFilePath = '' )
  { 
    if ( file_exists( $jsonFilePath ) )
    { 
      $jsonString = file_get_contents( $jsonFilePath );
     
      $jsonObject = json_decode( $jsonString );
     
      if ( is_array( $jsonObject->articles ) )
      { 
        $this->theBlogs = $jsonObject->articles;
      }
    
      else
      { // Display an error message
        echo '<p>WARNING: Something seems to be wrong with this blog!</p>';
      }
    }
    
    else
    { // Display an error message
      echo '<p>WARNING: This file doesnt exist!</p>';
    }
  }

  // Display all of the blogposts.
  public function output ()
  { 
    if ( is_array( $this->theBlogs ) && !empty( $this->theBlogs ) )
    { // Heading
      echo '<h2>Blogpost Items</h2><ol>';
      
      foreach ( $this->theBlogs as $myblog )
      { 
        $newBlog = new Blog( $myblog->id, $myblog->title, $myblog->content );
        // Display out the outputs.
        echo '<li>'.$newBlog->output( FALSE ).'</li>';
      } 
      echo '</ol>';
    }
  }

  
  public function findblogByIndex ( $id = FALSE )
  { 
    if ( is_integer( $id ) )
    { 
      if ( isset( $this->theBlogs[$id] ) )
      { 
        $displayBlog = new Blog(
          $this->theBlogs[$id]->id,
          $this->theBlogs[$id]->title,
          $this->theBlogs[$id]->content
        );
        // Output the Blogposts
        $displayBlog->output();
      }
      
      else
      { 
        echo '<p>Nothing could be found for blog at ID: '.$id.'!</p>';
      }
    }
    else
    { 
      echo '<p>The ID passed is invalid; not able to find blog for ID: '.$id.'.</p>';
    }
  }
}