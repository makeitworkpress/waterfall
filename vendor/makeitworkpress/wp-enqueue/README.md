# wp-enqueue
The WP Enqueue class provides a wrapper to make enqueueing scripts and styles in WordPress more easily.

WP Enqueue is maintained by [Make it WorkPress](https://makeitwork.press/scripts/wp-enqueue/).

## Usage
Include the WP Enqueue class in your plugin, theme or child theme file or use an autoloader. You can read more about autoloading in [the readme of wp-autoload](https://github.com/makeitworkpress/wp-autoload). 

### Add your scripts and styles as one array
You can add scripts and styles in one array, following the syntax as advised by WordPress. The script automatically recognizes whether you are adding a stylesheet or css file. In addition, you can add additional parameters to alter the behaviour of your scripts and styles.

A basic example of an array of assets:

```php
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
```
            
All scripts and styles are enqueued with a priority of 20, which is later as the default usage.

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

**type (string)**
Enforces the type enqueued (a script or style). Usefull if enqueuing scripts or styles that do not have a suffix, such as Google Fonts. Accepts ``'script'`` or ``'style'``.

### Additional Properties
You can add additional properties in your array which extend the functionality of enqueueing.

**name (string)**
The name for the object if you want to localize data to a script using wp_localize_script. This is the name of the variable used.

**localize (array)**
The array with data which you want to have localized. The ``'name'`` property is required and is the name of the variable.

**action (string)**
Allows to determine the action by using ``'enqueue'``, ``'dequeue'`` or ``'register'``. For example, if you add a css stylesheet with action register as key, this will result in the stylesheet being registered using wp_enqueue_style.

**context (string)**
Allows you to specifically define the context in which something needs to be enqueued using ``'admin'``, ``'login'``, ``'block-editor'``, ``'block-assets'``, or ``'both'``. Only on the admin side, on the front-end, or on both? You can also add your assets to the login page, the on the Gutenberg Editor (``'block-editor'``) and Gutenberg Block Assets (``'block-assets'``).

**exclude (array)**
Accepts an array with admin page hooks, such as ``'edit.php'`` on which you want to exclude the enqueueing of admin scripts and styles or a set of conditionals such as ``'is_page'`` for front-end enqueing.

**include (array)**
Accepts an array with admin page hooks, such as ``'edit.php'`` on which you want to include the enqueueing of admin scripts and styles or a set of conditionals such as ``'is_page'`` for front-end enqueing.

### Create instance
Create a new instance of the WP_Enqueue class with your assets array as argument.

```php
$enqueue = new MakeitWorkPress\WP_Enqueue\Enqueue($assets);
```
