phileInlineImage
================

A plugin for [Phile](https://github.com/PhileCMS/Phile) to take an image name and generate a wrapped image tag.

### 1.1 Installation (composer)
```
php composer.phar require phile/inline-image:*
```

### 1.2 Installation (Download)

* Install the latest version of [Phile](https://github.com/PhileCMS/Phile)
* Clone this repo into `plugins/phile/inlineImage`

### 2. Activation

After you have installed the plugin. You need to add the following line to your `config.php` file:

```
$config['plugins']['phile\\inlineImage'] = array('active' => true);
```

### Usage

Some example markdown input:

```markdown
## This is a Sub Page

This is page.md in the "sub" folder.

icon.png

Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
```

This is what will be output. You can see that `icon.png` was wrapped with some HTML:

```html
<h2>This is a Sub Page</h2>
<p>This is page.md in the "sub" folder.</p>
<p class="content-image">
  <img src="http://localhost:8888/phile/content/images/icon.png">
</p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
```

### Config

This is the default `config.php` file. It explains what each key => value does.

```php
return array(
  'images_dir' => 'content/images/', // the folder where your images exist
  'wrap_element' => 'p', // the element to wrap the img tag in
  'wrap_class' => 'content-image' // the class to apply to the wrap element
  );
```

You can see how the plugin applies the config data to the HTML output.

The `images_dir` should be relative to the root of the Phile installation (the constant `ROOT_DIR` will contain your root path).
