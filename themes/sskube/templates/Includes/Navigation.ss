<div id="offcanvas-left" class="hide">
    <a href="#" class="close big"></a>
    <nav>
        <ul id="Nav">
            <% loop Menu(1) %>
                <li class="$FirstLast">
                    <a href="$Link" class="$LinkingMode">$MenuTitle</a>
                    <% if ChildrenShowInMenu %>
                        <ul>
                            <% loop ChildrenShowInMenu %>
                                <% if ShowInMenus %>
                                    <li class="$FirstLast">
                                        <a href="$Link" class="$LinkingMode">$MenuTitle</a>
                                        <% if ChildrenShowInMenu %>
                                            <ul>
                                                <% loop ChildrenShowInMenu %>
                                                    <% if ShowInMenus %>
                                                        <li class="$FirstLast">
                                                            <a href="$Link" class="$LinkingMode">$MenuTitle</a>
                                                        </li>
                                                    <% end_if %>
                                                <% end_loop %>
                                            </ul>
                                        <% end_if %>
                                    </li>
                                <% end_if %>
                            <% end_loop %>
                        </ul>
                    <% end_if %>
                </li>
            <% end_loop %>
        </ul>
    </nav>
</div>
