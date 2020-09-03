<div id="Product" class="col-8 <% if IsOlderVersion %>olderVersion<% end_if %>">
<% include LayoutProductInner %>
</div>

<aside class="col-4">
    <div id="Sidebar">
        <div class="sidebarTop"></div>
        <% include Sidebar_PreviousAndNextProduct %>
        <% include Sidebar_Cart %>
        <% include Sidebar_Currency %>
        <% include Sidebar_UserAccount %>
        <% include Sidebar %>
        <div class="sidebarBottom"></div>
    </div>
</aside>
