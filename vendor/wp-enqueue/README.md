# wp-enqueue
The WP Enqueue class provides a wrapper to make enqueueing scripts and styles in WordPress more easily.

## Usage
Include the WP Enqueue class in your plugin, theme or child theme file or use an autoloader. 

### Add your scripts and styles as one array
You can add scripts and styles in one array, following the syntax as advised by WordPress. The script automatically recognizes whether you are adding a stylesheet or css file. In addition, you can add additional parameters to alter the behaviour of your scripts and styles.

A basic example of an array of assets:

            $assets = array(
                array('handle' => 'some-js', 'src' => get_stylesheet_directory_uri() . '/test.js', 'deps' => array(), 'ver' => NULL, 'in_footer' => true)
                array('handle' => 'some-css', 'src' => get_stylesheet_directory_uri() . '/test.css', 'deps' => array(), 'ver' => NULL, 'media' => 'all'),                
                array('handle' => 'some-css-front-and-admin', 'src' => get_stylesheet_directory_uri() . '/test.css', 'context' => 'both'),                
                array('handle' => 'some-admin-js', 'src' => get_stylesheet_directory_uri() . '/admin.js', 'context' => 'admin')
                array('handle' => 'some-login-css', 'src' => get_stylesheet_directory_uri() . '/login.css', 'context' => 'login')
                array('handle' => 'some-exluded-css', 'src' => get_stylesheet_directory_uri() . '/exclude.css', 'context' => 'admin', 'exclude' => array('edit.php'))
                array('handle' => 'some-included-css', 'src' => get_stylesheet_directory_uri() . '/include.css', 'context' => 'admin', 'include' => array('edit.php'))
                array('handle' => 'some-existing-css', 'action' => 'dequeue')
            );
            
All scripts and styles are enqueued with a priority of 20, so later as the default usage.

### Basic Properties
The basic properties follow the definitions as set by WordPress.

**handle (string)**
The handle to register your script or style one.

**src (string)**
The uri to where the script or style can be found.

**deps (array)**
The array with dependencies which need to be load if this script or style is enqueued.

**ver (string)**
The version of the script or style.

**in_footer (boolean)**
Whether the script should be load just before the closing of the body tag or in the head section. Only applies to scripts.

**media (string)**
For which media the stylesheet is. Only applies to styles.

### Additional Properties
You can add additional properties in your array which extend the functionality of enqueueing.

**action (string)**
Allows to determine the action by using 'enqueue', 'dequeue' or 'register'. For example, if you add a css stylesheet with action register as key, this will result in the stylesheet being registered using wp_enqueue_style.

**context (string)**
Allows you to specifically define the context in which something needs to be enqueued using 'admin', 'login', 'both'. Only on the admin side, on the front-end or on both?  You can also add your assets to the login page.

**exclude (array)**
Accepts an array with admin page hooks, such as edit.php on which you want to exclude the enqueueing of admin scripts and styles

**include (array)**
Accepts an array with admin page hooks, such as edit.php on which you want to include the enqueueing of admin scripts and styles

### Create instance
Create a new instance of the WP_Enqueue class with your assets array as argument.

            $enqueue = new Classes\WP_Enqueue\MT_WP_Enqueue($assets);
