
<% if $Siblings || $MenuChildren %>
<div class="sidebarBox" id="SidebarChildren">
<% if $Siblings %>
    <h3>Also See</h3>
    <% if $Parent %>
    <p class="parentPageInfo">Other pages in the <% with Parent %><a href="$Link">$Title</a><% end_with %> section.</p>
    <% end_if %>
    <ul>
        <% loop Siblings %><li class="$FirstLast $LinkingMode"><a href="$Link">$MenuTitle</a></li><% end_loop %>
    </ul>
<% end_if %>
<% if $MenuChildren %>
    <h3>More Details</h3>
    <p>In the $MenuTitle section:</p>
    <ul>
        <% loop MenuChildren %><li class="$FirstLast $LinkingMode"><a href="$Link">$MenuTitle</a></li><% end_loop %>
    </ul>
<% end_if %>
</div>
<% end_if %>


<% if SearchForm %>
<div class="sidebarBox" id="SidebarSearch">
    <h3>For Searchers</h3>
    <div class="searchFormOuter">$SearchForm</div>
</div>
<% end_if %>


<div class="sidebarBox" id="RandomImage">
    <h3>for innovators</h3>
    <p>Startups we support:</p>
    <ul>
        <li><a href="http://www.kaenga.com/">kaenga.com</a>: an organisation that promotes innovation in housing; and</li>
        <li><a href="http://www.evs.nz/">evs.nz</a>: promotes the uptake of electric vehicles;</li>
    </ul>

    <% if RandomImage %>
    <h3 id="RandomVisualThoughtHeader">For Hipsters</h3>
    <div id="RandomVisualThought" style="background-image: url($RandomImage);" data-rel="$RandomImage"></div>
    <p id="RandomVisualThoughtExplanation">
        Prefer dark web / hipster / random?
    <p>
    <% end_if %>

    <h3>for Developers</h3>
    <p>
        The sites listed below are a bunch of tools we built that may be of interest to developers and Silverstripe enthusiasts:
    </p>
    <ul>
        <li><a href="http://dataobject-generator.silverstripe-webdevelopment.com">dataobject generator</a>: a micro site for building your Silverstripe Model;</li>
        <li><a href="http://move-a-silverstripe-site.ssmods.com">move a silverstripe site</a>: a micro site for transferring Silvertripe sites;</li>
        <li><a href="http://www.silverstripe-ecommerce.com/">silverstripe-ecommerce.com</a>: our e-commerce demo;</li>
        <li><a href="http://www.ssmods.com/">ssmods.com</a>: find the world's best Silverstripe themes and modules;</li>
        <li><a href="http://topics.ssmods.com/">topics.ssmods.com</a>: Silverstripe modules categorised by topic;</li>
        <li><a href="http://docs.ssmods.com/">docs.ssmods.com</a>: API for all Silverstripe modules;</li>
        <li><a href="http://www.upgradesilverstripe.com/">upgradesilverstripe.com</a>: help with upgrading your silverstripe sites; and</li>
        <li><a href="http://www.silverstripe-webdevelopment.com/">silverstripe-webdevelopment.com</a>: notes for developers.</li>
    </ul>
</div>
