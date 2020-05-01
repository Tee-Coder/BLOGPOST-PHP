<?php // include_once is used to ensure this code is not included/run multiple times.
// In the case of a class declaration, it would cause an error to run multiple times!
include_once dirname( __FILE__ ) . '/Blogpost.Class.php';
class Blogs
{
  // Properties.
  private $theBlogs = array();

  // Methods.

  function __construct ( $jsonFilePath = '' )
  { // Check if the file exists.
    if ( file_exists( $jsonFilePath ) )
    { // Will retrieve the file contents as a string.
      $jsonString = file_get_contents( $jsonFilePath );
      // Convert the JSON string to a PHP object.
      $jsonObject = json_decode( $jsonString );
      // Check if the "blogs" are an array.
      if ( is_array( $jsonObject->articles ) )
      { // Store the array in our property.
        $this->theBlogs = $jsonObject->articles;
      }
      // If blogs are NOT an array.
      else
      { // Show a warning in the browser.
        echo '<p>WARNING: The blogs appear to be malformed!</p>';
      }
    }
    // If file doesn't exist.
    else
    { // Show a warning in the browser.
      echo '<p>WARNING: Your file doesn\'t exist!</p>';
    }
  }

  // Output all of the blogs.
  public function output ()
  { // If there ARE blogs.
    if ( is_array( $this->theBlogs ) && !empty( $this->theBlogs ) )
    { // Heading, and open our unordered list.
      echo '<h2>blogs List</h2><ol>';
      // Loop through the blogs!
      foreach ( $this->theBlogs as $myblog )
      { // Create an instance of our OTHER class: blog! Pass in the values.
        $newBlog = new Blog( $myblog->id, $myblog->title, $myblog->content );
        // Echo out our result.
        echo '<li>'.$newBlog->output( FALSE ).'</li>';
      } // Close the unordered list.
      echo '</ol>';
    }
  }

  // Find a particular blog.
  public function findblogByIndex ( $id = FALSE )
  { // Check if the submission is a number (integer.)
    if ( is_integer( $id ) )
    { // Check if the blog at this INDEX even EXISTS!?
      if ( isset( $this->theBlogs[$id] ) )
      { // Retrieve that blog from the array!
        $displayBlog = new Blog(
          $this->theBlogs[$id]->id,
          $this->theBlogs[$id]->title,
          $this->theBlogs[$id]->content
        );
        // Output that blog!
        $displayBlog->output();
      }
      // If the blog is not found...
      else
      { // Output a warning for the user.
        echo '<p>Sorry, we couldn\'t find a blog at ID: '.$id.'!</p>';
      }
    }
    // No ID, or an invalid ID was passed.
    else
    { // Output a warning for the user.
      echo '<p>No ID, or an invalid ID was passed; unable to find blog for ID: '.$id.'.</p>';
    }
  }
}