<div id="top"></div>


<br />
<div align="center">
    <a href="https://github.com/othneildrew/Best-README-Template" style="fill: #10B981; width:100px; display:block;">
        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M7 7H5A2 2 0 0 0 3 9V17H5V13H7V17H9V9A2 2 0 0 0 7 7M7 11H5V9H7M14 7H10V17H12V13H14A2 2 0 0 0 16 11V9A2 2 0 0 0 14 7M14 11H12V9H14M20 9V15H21V17H17V15H18V9H17V7H21V9Z"/></svg>
    </a>

    <h3 align="center">ParkourLabs.com REST API</h3>

    <p align="center">
        This is a small plugin to utilise the ParkourLabs.com REST API custom post types and their images. The provided shortcode will display a "stack" of images from those images. 
        <a href="https://github.com/IORoot/wp-plugin__REST--labs"><strong>Explore the repo »</strong></a>
    </p>
</div>



##  1. <a name='TableofContents'></a>Table of Contents


* 1. [Table of Contents](#TableofContents)
* 2. [About The Project](#AboutTheProject)
	* 2.1. [Built With](#BuiltWith)
	* 2.2. [Installation](#Installation)
* 3. [Usage](#Usage)
	* 3.1. [`[andyp_labs_stack]`](#andyp_labs_stack)
	* 3.2. [`[andyp_labs_rest]`](#andyp_labs_rest)
* 4. [Customising](#Customising)
* 5. [Troubleshooting](#Troubleshooting)
* 6. [Contributing](#Contributing)
* 7. [License](#License)
* 8. [Contact](#Contact)



##  2. <a name='AboutTheProject'></a>About The Project

This wordpress plugin was created to pull in the latest images from ParkourLabs.com into LondonParkour.com so that a nice "Stack" CSS-effect of images could be displayed to show the latest tutorial posts.
To accomplish this, two parts needs to happen:
1. ParkourLabs needed to extend it's REST API so that the custom post type and associated images could be queried.
1. LondonParkour needed a shortcode to communicate with that REST API endpoint, pull the images and render them out in the "stack".

This plugin concentrates on the second part. It communicates with the API and pulls data.

<p align="right">(<a href="#top">back to top</a>)</p>



###  2.1. <a name='BuiltWith'></a>Built With

This project was built with the following frameworks, technologies and software.

* [SASS](https://sass-lang.com/)
* [PHP](https://php.net/)
* [Wordpress](https://wordpress.org/)
* [Composer](https://getcomposer.org/)
* [Tailwind](https://tailwindcss.com/)

<p align="right">(<a href="#top">back to top</a>)</p>




###  2.2. <a name='Installation'></a>Installation

These are the steps to get up and running with this plugin.

1. Clone the repo into your wordpress plugin folder
    ```sh
    git clone https://github.com/IORoot/wp-plugin__REST--labs.git ./wp-content/plugins/ParkourLabs_REST_API
    ```
1. Insert one of the two shortcodes into your page.
    ```php
    [andyp_labs_stack] or [andyp_labs_rest]
    ```

<p align="right">(<a href="#top">back to top</a>)</p>



##  3. <a name='Usage'></a>Usage

There are two shortcodes available:

###  3.1. <a name='andyp_labs_stack'></a>`[andyp_labs_stack]`

The `[andyp_labs_stack]` shortcode can be used to automatically query the ParkourLabs.com REST API and render the image stack.
Just place wherever needed in your page.

This has a couple of features worth noting:

1. It uses transients of one day. This is to cache the results.
1. It styles the output based on the TailwindCSS Framework.


###  3.2. <a name='andyp_labs_rest'></a>`[andyp_labs_rest]`

This shortcode allows for much more flexibility. There are six parameters that can be used to control the output.

1. The number of results you wish to retrieve. Default is 5.
```php
[andyp_labs_rest count="10"]
```

2. The column of data to order the results. Default is "date"
```php
[andyp_labs_rest order="date"]
```

3. The posttype to actually search upon. The default is "tutorial".
```php
[andyp_labs_rest posttype="post"]
```

4. The category name to filter the results upon. The default is null.
```php
[andyp_labs_rest category="demos"]
```

5. The classes you wish to add to the resulting images. The default is empty.
```php
[andyp_labs_rest classes="w-10 block rounded"]
```

6   The `content` is anything that's between and opening and close tag. This allows for `{{moustache}}` brackets to substitute any post column to substituted for its value:
```php
[andyp_labs_rest]
    This is the title: {{post_title}}
[/andyp_labs_rest]
```

Using this shortcode allows you return multiple posts and display their details:
e.g.
```html
[andyp_labs_rest posttype="post" count="10" classes="w-10 rounded p-4 bg-gray-500"]
    <h1>{{post_title}} : {{published_date}}</h1>
[/andyp_labs_rest]
```


##  4. <a name='Customising'></a> Customising

You can simply change the endpoint in the code here:

[https://github.com/IORoot/wp-plugin__REST--labs/blob/master/src/REST/labs_rest.php](https://github.com/IORoot/wp-plugin__REST--labs/blob/master/src/REST/labs_rest.php)

Line 20:
```php
public $endpoint = "https://parkourlabs.com/wp-json/wp/v2";
```

[https://github.com/IORoot/wp-plugin__REST--labs/blob/master/src/REST/labs.php](https://github.com/IORoot/wp-plugin__REST--labs/blob/master/src/REST/labs.php)
Line 14

```php
public $endpoint = "https://parkourlabs.com/wp-json/wp/v2";
```

##  5. <a name='Troubleshooting'></a>Troubleshooting

If the site is not picking up the JSON and images delete the transients using the WP CLI tool.

```
sudo -u www-data wp transient list
sudo -u www-data wp transient delete labsrest-blog
sudo -u www-data wp transient delete labsrest-demonstration
sudo -u www-data wp transient delete labsrest-tutorial
sudo -u www-data wp transient delete labsstack
```

<p align="right">(<a href="#top">back to top</a>)</p>



##  6. <a name='Contributing'></a>Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue.
Don't forget to give the project a star! Thanks again!

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

<p align="right">(<a href="#top">back to top</a>)</p>



##  7. <a name='License'></a>License

Distributed under the MIT License.

<p align="right">(<a href="#top">back to top</a>)</p>



##  8. <a name='Contact'></a>Contact

Author Link: [https://github.com/IORoot](https://github.com/IORoot)

<p align="right">(<a href="#top">back to top</a>)</p>
