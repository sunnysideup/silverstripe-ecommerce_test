
<main id="Product" class="main-section content-container with-sidebar">
    <div class="typography content-padding  <% if IsOlderVersion %>olderVersion<% end_if %>">
        <% include LayoutProductInner %>
    </div>
</main>

<aside>
    <div id="Sidebar" class="typography content-padding">
        <div class="sidebarTop"></div>
        <% include Sidebar_PreviousAndNextProduct %>
        <% include Sidebar_Cart %>
        <% include Sidebar_Currency %>
        <% include Sidebar_UserAccount %>
        <% include Sidebar %>
        <div class="sidebarBottom"></div>
    </div>
</aside>
