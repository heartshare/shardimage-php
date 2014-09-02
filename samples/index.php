<?php

namespace ShardImage;
//7736b0e..b77c6e7
$api_key = '28039082405588';
$api_secret = '$2y$12$LJeVekXtJbwwuEvOwxANTuVPAutM6UK/F4OChq.M2nIqAT.MDYjuu';

error_reporting(E_ALL);
ini_set('display_errors', 1);
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
                                <a href="/index.php?sample=image&action=upload">Upload</a>
                            </li>
                            <li>
                                <a href="/index.php?sample=image&action=show">Show</a>
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
            $actions = array(
                'index',
                'store',
                'show',
                'update',
                'delete',
                'upload'
                );

            if (isset($_GET['sample'])
            && isset($_GET['action'])
            && file_exists($_GET['sample'] . '.php')
            && in_array($_GET['action'], $actions))
            {
                echo '<pre>' . var_export(include $_GET['sample'] . '.php', true) . '</pre>';
            }
            ?>
        </div>
    </body>

</html>
