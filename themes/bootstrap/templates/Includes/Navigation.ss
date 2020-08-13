<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
    <a href="/" class="home-button">$SiteConfig.Title</a>
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
<% loop Menu(1) %>
<% if $Children %>
    <li class="nav-item dropdown <% if $LinkingMode = 'current' %>active<% end_if %>">
      <a class="nav-link dropdown-toggle" href="$Link" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        $MenuTitle <% if $LinkingMode = 'current' %><span class="sr-only">(current)</span><% end_if %>
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <% loop $Children %>
        <a class="dropdown-item" href="$Link">$MenuTitle</a>
        <% end_loop %>
      </div>
    </li>

<% else %>
    <li class="nav-item <% if $LinkingMode = 'current' %>active<% end_if %>">
      <a class="nav-link" href="$Link">$MenuTitle<% if $LinkingMode = 'current' %><span class="sr-only"> (current)</span><% end_if %></a>
    </li>
<% end_if %>
<% end_loop %>
    </ul>
  </div>
</nav>
