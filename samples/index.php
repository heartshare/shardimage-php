<?php

namespace Sample;
$api_key = '';
$api_secret = '';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>ShardImage - Sample</title>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <div id="menu">
            <div>
                <ul>
                    <li class="menu-item">
                        <a href="#">Images</a>
                        <ul>
                            <li>
                                <a href="/index.php?sample=image&action=index">List</a>
                            </li>
                            <li>
                                <a href="/index.php?sample=image&action=store">Create</a>
                            </li>
                            <li>
                                <a href="/index.php?sample=image&action=show">Show</a>
                            </li>
                            <li>
                                <a href="/index.php?sample=image&action=update">Update</a>
                            </li>
                            <li>
                                <a href="/index.php?sample=image&action=delete">Delete</a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item">
                        <a href="#">Restricted</a>
                        <ul>
                            <li>
                                <a href="/index.php?sample=restricted&action=store">Upload image from URL</a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item">
                        <a href="#">Clouds</a>
                        <ul>
                            <li>
                                <a href="/index.php?sample=cloud&action=index">List</a>
                            </li>
                            <li>
                                <a href="/index.php?sample=cloud&action=store">Create</a>
                            </li>
                            <li>
                                <a href="/index.php?sample=cloud&action=show">Show</a>
                            </li>
                            <li>
                                <a href="/index.php?sample=cloud&action=update">Update</a>
                            </li>
                            <li>
                                <a href="/index.php?sample=cloud&action=delete">Delete</a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item">
                        <a href="#">Filters</a>
                        <ul>
                            <li>
                                <a href="/index.php?sample=filter&action=index">List</a>
                            </li>
                            <li>
                                <a href="/index.php?sample=filter&action=store">Create</a>
                            </li>
                            <li>
                                <a href="/index.php?sample=filter&action=show">Show</a>
                            </li>
                            <li>
                                <a href="/index.php?sample=filter&action=update">Update</a>
                            </li>
                            <li>
                                <a href="/index.php?sample=filter&action=delete">Delete</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <ul>
                            <li>
                                <a href="/index.php?sample=web&action=index">Web</a>
                            </li>
                        </ul>
                    </li>
                </ul>     
            </div>
        </div>
        <div>
            <?php
            $actions = ['index', 'store', 'show', 'update', 'delete'];

            if (isset($_GET['sample']) && isset($_GET['action'])) {
                if (file_exists($_GET['sample'] . '.php') && in_array($_GET['action'], $actions)) {
                    echo '<pre>' . var_export(include $_GET['sample'] . '.php', true) . '</pre>';
                }
            }
            ?>
        </div>
    </body>

</html>
