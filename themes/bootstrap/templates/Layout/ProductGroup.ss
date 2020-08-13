<div id="$AjaxDefinitions.ProductListHolderID"  class="col-8">
<% if ProductGroupListAreCacheable %>
    <% cached ProductGroupListCachingKey %>
        <% include LayoutProductGroupInner %>
    <% end_cached %>
<% else %>
    <% include LayoutProductGroupInner %>
<% end_if %>


</div>

<aside class="col-4">
    <div id="Sidebar">
        <div class="sidebarTop"></div>
        <% include Sidebar_Cart %>
        <% include Sidebar_Currency %>
        <% include Sidebar_UserAccount %>
        <% include Sidebar %>
        <div class="sidebarBottom"></div>
    </div>
</aside>
