<main class="main-section content-container with-sidebar">
    <div class="typography content-padding" id="$AjaxDefinitions.ProductListHolderID">
        <% if ProductGroupListAreCacheable %>
            <% cached ProductGroupListCachingKey %>
                <% include LayoutProductGroupInner %>
            <% end_cached %>
        <% else %>
            <% include LayoutProductGroupInner %>
        <% end_if %>
    </div>
</main>

<aside>
    <div id="Sidebar" class="typography content-padding">
        <div class="sidebarTop"></div>
        <% include Sidebar_Cart %>
        <% include Sidebar_Currency %>
        <% include Sidebar_UserAccount %>
        <% include Sidebar %>
        <div class="sidebarBottom"></div>
    </div>
</aside>
