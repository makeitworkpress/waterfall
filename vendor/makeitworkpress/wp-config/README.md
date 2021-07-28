# wp-config
A class for setting up configurations in WordPress projects. 

WP Config is maintained by [Make it WorkPress](https://makeitwork.press/scripts/wp-config/).

## Usage
The WP Config class set-ups a single configurations object which can be used for your configuration files within custom theme and plugin development. You can use it to set-up a configurations object by injecting an array of configurations upon constructing.

To use this class, you must include this class inside your theme, plugin, require the src/config.php file or load it using an autoloader or Composer. You can read more about autoloading in [the readme of wp-autoload](https://github.com/makeitworkpress/wp-autoload).

### Initializing Configurations
Initialize the configurations object and pass your configuration. Your configurations array or string may be the default configurations.

```php
$configurations = new MakeitWorkPress/WP_Configurations/Config( string|array $configuration );
``` 

If a string is passed, it expects this string to be the filename of the file that returns an array with configurations. Thus, this file should return an array.

After initialisation, configurations become accessible through the public $configurations property. Hence, the following will return the current configurations:

```php
return $configurations->configurations;
``` 

### Modifying Configurations
Configurations can be modified using the add method. The add method will parse existing configurations with the ones you are adding in a multidimensional way.

```php
$configurations->add( string $type, array $configurations );
```

The parameter $type refers to the first level key of your original configurations array. The array configurations may be the configurations you want to add or alter. Please look to the example of how this works in practice.

### Example
The following example loads configurations directly from an array.

```php
$configurations = new MakeitWorkPress/WP_Configurations/Config( [
    'options' => [
        'context' => 'admin'
        'fields'  => [
            [
                'id'    => 'field_id',
                'label' => __('Field Label', 'textdomain'),
                'type'  => 'input'
            ]
        ]
    ]
] );
``` 

&nbsp;
And this example loads the configurations from a file.
```php
$configurations = new MakeitWorkPress/WP_Configurations/Config( 'home/app/appname/wp-content/themes/theme/config/settings.php' );
``` 

&nbsp;
The following example adds another field to our options defined within the configuration. Because WP Config parses in a multidimensional way, the earlier defined field and keys are preserved.
```php
$configurations->add( 'options', [
    'fields' => [
        [
            'id'    => 'field_id_two',
            'label' => __('Field Label Two', 'textdomain'),
            'type'  => 'input'            
        ]
    ]
] )
``` 

If we then return our configurations object, we may expect the following result.
```php
return $configurations->configurations;

// Result
[
    'options' => [
        'context' => 'admin'
        'fields'  => [
            [
                'id'    => 'field_id',
                'label' => __('Field Label', 'textdomain'),
                'type'  => 'input'
            ],
            [
                'id'    => 'field_id_two',
                'label' => __('Field Label Two', 'textdomain'),
                'type'  => 'input'            
            ]            
        ]
    ]    
]
``` 
