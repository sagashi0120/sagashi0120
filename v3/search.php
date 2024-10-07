<?php
error_reporting(0);
session_start();
$session = [];
switch($_SESSION["user"]) {
    case true:
        $session["image"] = 2;
        $session["alt"] = "ログイン済み";
        break;
    default:
        $session["image"] = 1;
        $session["alt"] = "ログアウト状態";
}
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>さがしマート - 検索「<?=$_GET["q"]?>」</title>
        <link rel="stylesheet" href="/css/style.css" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
        <script async src="https://cse.google.com/cse.js?cx=e7b2c92b99d704586"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script src="/js/jquery.autocomplete.js"></script>
        <link rel="stylesheet" href="/css/jquery.autocomplete.css" />
        <script>
            $(document).ready(function(){
                $("#text").autocomplete("./autocomplete");
            });
        </script>
    </head>
    <body>
        <div class="modal fade" id="accountModal" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel1">アカウント</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="micModal" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel2">マイク検索</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="mic_stop1"></button>
                    </div>
                    <div class="modal-body">
                        <p id="mic_control" style="display:none">
                            <span id="result_text"></span><br>
                            <span id="status"></span>
                        </p>
                        <button id="mic_stop2" class="btn btn-danger">停止</button>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar" style="border-radius: 10px;background-color: #e3f2fd;">
            <div class="container-fluid">
                <div class="navbar-brand">
                    <a href="/"><img src="/images/logo-header.png" width="200"></a>
                </div>
                <div class="d-flex" style="width: 50%;"></div>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel" style="border-radius: 10px;">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu bar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <label class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#accountModal">
                                <img src="/images/account<?=$session["image"]?>.png" width="30" height="30" alt="<?=$session["alt"]?>">
                                アカウント
                            </label>
                            <li class="nav-item">
                                <a class="nav-link" href="/">ホーム</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/diffe/">間違い探し</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/blog/">ブログ</a>
                            </li>
                            <pre><?=file_get_contents("txt/version.txt")?></pre>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div>
            <form action="/search" method="get">
                <div class="container input-group">
                    <input type="text" id="text" class="form-control" name="q" placeholder="ここに検索キーワードを入力" value="<?=$_GET["q"]?>">
                    <button type="submit" class="btn btn-outline-primary" id="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    <button type="button" class="btn btn-outline-info" id="start_recognition" data-bs-toggle="modal" data-bs-target="#micModal">
                        <i class="fa-solid fa-microphone"></i>
                    </button>
                </div>
            </form>
            <form name="googleform" action="/search">
                <input type="hidden" id="search_param" name="q" maxLength="255" size="30">
            </form>
            <div class="gcse-searchresults-only"></div>
            <?php if($_GET["q"] == ""): ?>
            <div class="alert alert-warning">検索キーワードが入力されていません。</div>
            <?php endif; ?>
        </div>
        <script src="/js/mic.js"></script>
        <style>
        .gsc-richsnippet-showsnippet-label {
            margin-left: 1rem;
            margin-bottom: 1rem;
            text-decoration: none;
            color: orange;
        }
        .gsc-richsnippet-popup-box,
        .gsc-richsnippet-individual-snippet-box,
        .gsc-inline-block,
        .gsc-option-menu,
        .gs-imagePreviewArea,
        .gs-image-popup-box,
        .gs-image {
            border-radius: 10px;
        }
        .gsc-orderby-label {
            font-size: 0;
        }
        .gsc-orderby-label::before {
            font-size: 15px;
            content: "表示順：";
        }
        .gs-previewUrl {
            color: cyan;
        }
        .gsc-cursor {
            font-size: 15.5px;
        }
        </style>
    </body>
</html>