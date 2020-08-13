<div id="Page" class="mainSection content-container withSidebar">
<h2>Choose your download below:</h2>
	$Content
	<div id="VersionInfo" style="margin-top: 30px;">
	<h3>What Version should I use?</h3>
	<p>
		See <a href="https://github.com/sunnysideup/silverstripe-ecommerce">README.md</a> and
		<a href="https://github.com/sunnysideup/silverstripe-ecommerce">composer.json</a>
		in the e-commerce project.
	</p>
	</div>

	<h2 style="margin-top: 30px;">GIT Hub</h2>
	<div id="GITSectionBrowse" style="margin-top: 30px;">
		<h4>Browse</h4>
		<ul>
<% loop Downloads %><% if GITLink %><li><a href="$GITLink">$Title</a></li><% end_if %><% end_loop %>
		</ul>
	</div>

	<div id="GITSection" style="margin-top: 30px;">
		<h4>Sub-module Definition</h4>
		<p>Browse to the root of your Silverstripe GIT-based project. Then paste the lines you can copy below.</p>
		<pre style="white-space: pre;width: 956px!important">
<% loop Downloads %><% if FolderPadded %>git submodule add $GITLinkGIT $Folder
<% end_if %><% end_loop %>
		</pre>
	</div>

	<h2 style="margin-top: 30px;">SVN</h2>
	<div id="SVNSectionBrowse" style="margin-top: 30px;">
		<h4>Browse</h4>
		<ul>
<% loop Downloads %><% if SVNLink %><li><a href="$SVNLink">$Title</a></li><% end_if %><% end_loop %>
		</ul>
	</div>

	<div id="SVNSection" style="margin-top: 30px;">
		<h4>Externals Definition</h4>
		<p>To set these, using the command line, browse to the root folder of your Silvestripe SVN-based project and type:</p>
		<pre>svn propedit svn:externals .</pre>
		<p>Then paste the lines you can copy below.</p>
		<pre style="white-space: pre;width: 956px!important">
<% loop Downloads %><% if FolderPadded %>$FolderPadded $SVNLink
<% end_if %><% end_loop %>
		</pre>
		<p>To finalise type:</p>
		<pre>svn up</pre>
	</div>


	<div id="DownloadSection" style="margin-top: 60px;">
	<h2>Downloads</h2>
	<p>Only <a href="Security/login/?BackURL=$Link.ATT">logged in</a> users can download.</p>
	<ul>
<% loop Downloads %><% if DownloadLink %><li><a href="$DownloadLink">$Title</a></li><% end_if %><% end_loop %>
	</ul>
	</div>
</div>
<aside>
	<div id="Sidebar">
		<div class="sidebarTop"></div>
		<div id="SidebarPageContent" class="sidebarBox">
			<h4>Contents</h4>
			<ul>
				<li><a href="#VersionInfo">What Version Should I Use?</a></li>
				<li>GIT: <a href="#GITSectionBrowse">Browse</a>, <a href="#GITSection">Sub-modules</a></li>
				<li>SVN: <a href="#SVNSectionBrowse">Browse</a>, <a href="#SVNSection">Externals</a></li>
				<li><a href="#DownloadSection">Downloads</a></li>
			</ul>
		</div>
		<% include Sunnysideup\EcommerceTest\IncludesSidebar %>
		<div class="sidebarBottom"></div>
	</div></aside>

