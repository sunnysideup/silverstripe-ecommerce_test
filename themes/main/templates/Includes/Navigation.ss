<nav id="MainMenu">
    <ul id="Nav">
        <% loop Menu(1) %><li class="$LinkingMode level1">
       
            <a class="$LinkingMode level1" href="$Link">$MenuTitle</a>
        <% if Children %>
        <ul>
            <% loop Children %><% if ShowInMenus %>
            <li class="$FirstLast $LinkingMode"><a href="$Link">$MenuTitle</a></li>
            <% end_if %><% end_loop %>
        </ul>
        <% end_if %>
        </li><% end_loop %>
    </ul>
</nav>
<% require javascript(resources/themes/main/javascript/menu.js) %>
