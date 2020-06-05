<!DOCTYPE html>
<html lang="$ContentLocale">
<head>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Lato|Voces');
    </style>
<% if HasItsOwnExtendedMetatags %>
    <!-- has its own ExtendedMetaTags in Page.php -->
<% else %>
    <% if ExtendedMetaTags %>
    $ExtendedMetaTags
    <% else %>
    <% base_tag %>
    <title><% if $MetaTitle %>$MetaTitle<% else %>$Title<% end_if %> &raquo; $SiteConfig.Title</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    $MetaTags(false)
    <% require themedCSS('reset') %>
    <% require themedCSS('typography') %>
    <% require themedCSS('layout') %>
    <% require themedCSS('form') %>
    <% require themedCSS('menu') %>
    <% require themedCSS('individualPages') %>
    <% require themedCSS('print', 'print') %>

/**
  * ### @@@@ START REPLACEMENT @@@@ ###
  * WHY: automated upgrade
  * OLD: /images/ (case sensitive)
  * NEW: /client/images/ (COMPLEX)
  * EXP: Check new location, also see: https://docs.silverstripe.org/en/4/developer_guides/templates/requirements/#direct-resource-urls
  * ### @@@@ STOP REPLACEMENT @@@@ ###
  */
    <link rel="shortcut icon" href="$ThemeDir/client/images/favicon.ico" />
    <% end_if %>
<% end_if %>
</head>

/**
  * ### @@@@ START REPLACEMENT @@@@ ###
  * WHY: automated upgrade
  * OLD: $ClassName (case sensitive)
  * NEW: $`ClassName.ShortName (COMPLEX)
  * EXP: Check if the class name can still be used as such. The ShortName provides the name without NameSpace
  * ### @@@@ STOP REPLACEMENT @@@@ ###
  */
<body id="Body$`ClassName.ShortName" class="mobileBrowsing">
<div id="Wrapper">
    <% include Navigation %>
    <a href="#" class="menuButton">menu</a>
    <div id="Layout">
        <% include Breadcrumbs %>
        <div id="PageSpecificHolder">
        <% if $IsInHouseTemplate %>
            $Layout
        <% else %>

            <main class="main-section content-container with-sidebar">
                <div class="typography content-padding">
                $Layout
                </div>
            </main>

            <aside>
                <div id="Sidebar" class="typography content-padding">
                    <div class="sidebarTop"></div>
                    <% include Sidebar %>
                    <div class="sidebarBottom"></div>
                </div>
            </aside>

        <% end_if %>
        </div>
        <footer class="typography">
            <p class="backToTop"><a href="#Wrapper">back to top</a></p>
            <div id="CopyrightMessage">$SiteConfig.CopyrightNotice</div>
        </footer>
    </div>
</div>
    <% require javascript('resources/themes/main/javascript/menu.js') %>

</body>
</html>
