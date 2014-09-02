ShardImage
==========
ShardImage SDK

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist shardimage/shardimage-php "*"
```

or add

```
"shardimage/shardimage-php": "dev-master"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

Cloud
-----

URLs:

[php integration](http://shardimage.com/documentations/server-side/php#Cloud)

[yii integration](http://shardimage.com/documentations/server-side/yii#Cloud)

[laravel integration](http://shardimage.com/documentations/server-side/laravel#Cloud)


List clouds :

```
$cloud = new \ShardImage\Cloud(array('api_key' => $api_key, 'api_secret' => $api_secret));
$clouds = $cloud->index(array());
```

Create cloud :

```
$cloud = new \ShardImage\Cloud(array('api_key' => $api_key, 'api_secret' => $api_secret));

$parameters = array(
      'cloud' => array(
          'name' => 'Sample',
          'url_name' => $cloud->stringToURL('Sample'),
          'description' => 'Sample description',
          'enabled_domain_view' => 'The list of these domain names which allowed to serve images.',
          'enabled_domain_upload' => 'The list of these domain names which allowed from upload images.',
      )
);

$data = $cloud->store($parameters);
```

Show cloud :

```
$parameters = array(
    'cloud_id' => $cloud_id
);

$cloud = new \ShardImage\Cloud(array('api_key' => $api_key, 'api_secret' => $api_secret));
$data = $cloud->show($parameters);
```

Modify cloud :

```
$parameters = array(
    'cloud_id' => $cloud_id,
    'cloud' => array(
        'name' => 'Sample',
        'url_name' => $cloud->stringToURL('Sample'),
        'description' => 'Sample description',
        'enabled_domain_view' => 'The list of these domain names which allowed to serve images.',
        'enabled_domain_upload' => 'The list of these domain names which allowed from upload images.',
    )
);
$cloud = new \ShardImage\Cloud(array('api_key' => $api_key, 'api_secret' => $api_secret));
$data = $cloud->update($parameters);
```

Delete cloud :

```
$parameters = array(
    'cloud_id' => $cloud_id
);

$cloud = new \ShardImage\Cloud(array('api_key' => $api_key, 'api_secret' => $api_secret));
$data = $cloud->delete($parameters);
```

Filter
------

URLs:

[php integration](http://shardimage.com/documentations/server-side/php#Filter)

[yii integration](http://shardimage.com/documentations/server-side/yii#Filter)

[laravel integration](http://shardimage.com/documentations/server-side/laravel#Filter)

List filters :

```
$filter = new \ShardImage\Filter(array('api_key' => $api_key, 'api_secret' => $api_secret));
$filters = $filter->index(array());
```

Create filter :

```
$filter = new \ShardImage\Filter(array('api_key' => $api_key, 'api_secret' => $api_secret));

$parameters = array(
      'filter' => array(
          'cloud_id' => $cloud_id,
          'name' => 'Sample',
          'url_name' => $filters->stringToURL('Sample'),
          'data' => 'List of image manipulation what need to be taken.',
      )
);

$data = $filter->store($parameters);
```

Show filter :

```
$parameters = array(
    'filter_id' => $filters_id
);

$filter = new \ShardImage\Filter(array('api_key' => $api_key, 'api_secret' => $api_secret));
$data = $filter->show($parameters);
```

Modify filter :

```
$parameters = array(
    'filter_id' => $filters_id,
    'filter' => array(
        'cloud_id' => $cloud_id,
        'name' => 'Sample',
        'url_name' => $filter->stringToURL('Sample'),
        'data' => 'List of image manipulation what need to be taken.',
    )
);
$filter = new \ShardImage\Filter(array('api_key' => $api_key, 'api_secret' => $api_secret));
$data = $filter->update($parameters);
```

Delete filter :

```
$parameters = array(
    'filter_id' => $filters_id
);

$filter = new \ShardImage\Filter(array('api_key' => $api_key, 'api_secret' => $api_secret));
$data = $filter->delete($parameters);
```

Upload
------

URLs:

[php integration](http://shardimage.com/documentations/server-side/php#Upload)

[yii integration](http://shardimage.com/documentations/server-side/yii#Upload)

[laravel integration](http://shardimage.com/documentations/server-side/laravel#Upload)


```
$upload = new \ShardImage\Upload(array('api_key' => $api_key, 'api_secret' => $api_secret));

$parameters = array(
    'file' => $_FILES['uploadimage'],
    'parameters' => array(
        'cloud_id' => $cloud_id
    ),
);

$result = $upload->upload($parameters);
```

Restricted upload
-----------------

URLs:

[php integration](http://shardimage.com/documentations/server-side/php#Restricted)

[yii integration](http://shardimage.com/documentations/server-side/yii#Restricted)

[laravel integration](http://shardimage.com/documentations/server-side/laravel#Restricted)


```
$parameters = array(
    'restricted' => array(
        'cloud_id' => $cloud_id,
        'url' => 'https://www.youtube.com/watch?v=vgfLFLRXSdI'
    )
);
$restricted = new New Restricted(array('api_key' => $api_key, 'api_secret' => $api_secret));
$data = $restricted->store($parameters);
```

Supported sites:

[plus.google.com](https://plus.google.com/) (profile photos),

[facebook.com](https://www.facebook.com/) (profile photos),

[twitter.com](https://twitter.com/) (profile photos),

[vimeo.com](https://vimeo.com/) (video frames),

[youtube.com](https://www.youtube.com/) (video frames),

[gravatar.com](http://gravatar.com/) (profile photos).


Image
-----

URLs:

[php integration](http://shardimage.com/documentations/server-side/php#Image)

[yii integration](http://shardimage.com/documentations/server-side/yii#Image)

[laravel integration](http://shardimage.com/documentations/server-side/laravel#Image)


List images :

```
$image = new \ShardImage\Image(array('api_key' => $api_key, 'api_secret' => $api_secret));
$parameters = array(
    'take' => $take,
    'skip' => $skip
);
$images = $image->index($parameters);
```

Show image :

```
$parameters = array(
    'image_id' => $_id
);

$image = new \ShardImage\Image(array('api_key' => $api_key, 'api_secret' => $api_secret));
$data = $image->show($parameters);
```

Delete Image :

```
$parameters = array(
    'image_id' => $_id
);

$image = new \ShardImage\Image(array('api_key' => $api_key, 'api_secret' => $api_secret));
$data = $image->delete($parameters);
```
