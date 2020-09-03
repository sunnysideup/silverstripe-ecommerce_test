<!DOCTYPE html>
<html lang="$ContentLocale">
<head>
    $ExtendedMetaTags
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <% include WebpackCSSLinks %>
</head>

/**
  * ### @@@@ START REPLACEMENT @@@@ ###
  * WHY: automated upgrade
  * OLD: $ClassName (case sensitive)
  * NEW: $`ClassName.ShortName (COMPLEX)
  * EXP: Check if the class name can still be used as such. The ShortName provides the name without NameSpace
  * ### @@@@ STOP REPLACEMENT @@@@ ###
  */
<body id="Body$`ClassName.ShortName">
<div id="Wrapper">
    <header id="header">
        <div class="container">
            <a href="/" class="home-button">$SiteConfig.Title</a>
            <% include Navigation %>
            <a href="#" data-component="offcanvas" data-target="#offcanvas-left" id="menu-button">Menu</a>
        </div>
    </header
    <div id="Layout">
        <% include Breadcrumbs %>
        <div id="page-holder" class="container">
            $Layout
        </div>
        <% include Footer %>
    </div>
</div>
<% include WebpackJSLinks %>
</body>
</html>
