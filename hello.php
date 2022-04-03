HTTP/1.1 200 OK
Date: Sun, 03 Apr 2022 19:03:54 GMT
Content-Type: text/html; charset=utf-8
Transfer-Encoding: chunked
Connection: keep-alive
X-Frame-Options: DENY
Vary: Cookie, Accept-Encoding
Strict-Transport-Security: max-age=31536000; includeSubDomains; preload
X-Content-Type-Options: nosniff
X-Xss-Protection: 1; mode=block
Referrer-Policy: strict-origin-when-cross-origin,origin
Set-Cookie: csrftoken=68nedK4GoqzKCBQ1h4CozfX4PIM70d6OhWlGGOlYOLYf7A9SYgxiD5xUtMXzg0gr; expires=Sun, 02 Apr 2023 19:03:54 GMT; Max-Age=31449600; Path=/; SameSite=Lax; Secure
Via: 1.1 vegur
CF-Cache-Status: DYNAMIC
Expect-CT: max-age=604800, report-uri="https://report-uri.cloudflare.com/cdn-cgi/beacon/expect-ct"
Server: cloudflare
CF-RAY: 6f641124ea183b81-BOS
alt-svc: h3=":443"; ma=86400, h3-29=":443"; ma=86400

7cac

<!doctype html>
<html lang="en">
<head>
<link href="https://cdn.realpython.com" rel="preconnect">
<link href="https://files.realpython.com" rel="preconnect">
<title>Documenting Python Code: A Complete Guide – Real Python</title>
<meta name="author" content="Real Python">
<meta name="description" content="A complete guide to documenting Python code. Whether you&#x27;re documenting a small script or a large project, whether you&#x27;re a beginner or seasoned Pythonista, this guide will cover everything you need to know.">
<meta name="keywords" content="">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover">
<link rel="stylesheet" href="https://cdn.realpython.com/static/realpython.min.7472b7320c54.css">
<link rel="stylesheet" href="https://cdn.realpython.com/static/gfonts/font.08e909e5f3d4.css">
<link rel="preload" href="https://cdn.realpython.com/static/glightbox.min.f69035b3cab2.css" as="style" onload="this.onload=null;this.rel='stylesheet'"><noscript><link rel="stylesheet" href="https://cdn.realpython.com/static/glightbox.min.f69035b3cab2.css"></noscript>
<link rel="canonical" href="https://realpython.com/documenting-python-code/">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:image" content="https://files.realpython.com/media/Documenting-Python-Code_Watermarked.0b26408a1b7f.jpg">
<meta property="og:image" content="https://files.realpython.com/media/Documenting-Python-Code_Watermarked.0b26408a1b7f.jpg">
<meta name="twitter:creator" content="@realpython">
<meta name="twitter:site" content="@realpython">
<meta property="og:title" content="Documenting Python Code: A Complete Guide – Real Python">
<meta property="og:type" content="article">
<meta property="og:url" content="https://realpython.com/documenting-python-code/">
<meta property="og:description" content="A complete guide to documenting Python code. Whether you&#x27;re documenting a small script or a large project, whether you&#x27;re a beginner or seasoned Pythonista, this guide will cover everything you need to know.">
<link href="https://cdn.realpython.com/static/favicon.68cbf4197b0c.png" rel="icon">
<link href="https://realpython.com/atom.xml" rel="alternate" title="Real Python" type="application/atom+xml">
<link rel="manifest" href="/manifest.json">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-35184939-1', 'auto', {'allowLinker': true});

  

  

  
  
  ga('set', {
    dimension1: false,
    dimension2: false
  });
  

  ga('send', 'pageview');
  
</script>
<script async src='/cdn-cgi/bm/cv/669835187/api.js'></script></head>
<body>
<nav class="navbar fixed-top navbar-expand-lg navbar-dark flex-column ">
<div class="container flex-row">
<a class="navbar-brand" href="/">
<img src="https://cdn.realpython.com/static/real-python-logo.893c30edea53.svg" width="165" height="40" class="d-inline-block align-top" alt="Real Python">
</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse navbar-nav-scroll" id="navbarSupportedContent" role="navigation" aria-label="Main Navigation">
<ul class="navbar-nav mr-2 flex-fill">
<li class="nav-item">
<a class="nav-link" href="/start-here/">Start&nbsp;Here</a>
</li>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownLibrary" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<span class="fa fa-graduation-cap" aria-hidden="true"></span> Learn Python
</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdownLibrary">
<a class="dropdown-item" href="/" style="color: #ff7e73; line-height: 110%;"><i class="fa fa-fw mr-1 fa-graduation-cap" aria-hidden="true"></i> Python Tutorials →<br><small class="text-secondary">In-depth articles and tutorials</small></a>
<a class="dropdown-item" href="/courses/" style="color: #abe5b1; line-height: 110%;"><i class="fa fa-fw mr-1 fa-film" aria-hidden="true"></i> Video Courses →<br><small class="text-secondary">Step-by-step video lessons</small></a>
<a class="dropdown-item" href="/quizzes/" style="color: #abe0e5; line-height: 110%;"><i class="fa fa-fw mr-1 fa-trophy" aria-hidden="true"></i> Quizzes →<br><small class="text-secondary">Check your learning progress</small></a>
<a class="dropdown-item" href="/learning-paths/" style="color: #ffc873; line-height: 110%;"><i class="fa fa-fw mr-1 fa-map-o" aria-hidden="true"></i> Learning Paths →<br><small class="text-secondary">Guided study plans for accelerated learning</small></a>
<a class="dropdown-item" href="/community/" style="color: #e5c6ab; line-height: 110%;"><i class="fa fa-fw mr-1 fa-slack" aria-hidden="true"></i> Community →<br><small class="text-secondary">Learn with other Pythonistas</small></a>
<a class="dropdown-item pb-3" href="/tutorials/all/" style="color: #b8abe5; line-height: 110%;"><i class="fa fa-fw mr-1 fa-tags" aria-hidden="true"></i> Topics →<br><small class="text-secondary">Focus on a specific area or skill level</small></a>
<a class="dropdown-item border-top" href="/account/join/"><i class="fa fa-fw fa-star text-warning" aria-hidden="true"></i> Unlock All Content</a>
</div>
</li>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBooksCourses" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Store
</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdownBooksCourses">
<a class="dropdown-item" href="/account/join/"><i class="fa fa-fw fa-star text-warning" aria-hidden="true"></i> RP Membership</a>
<a class="dropdown-item" href="/products/python-basics-book/">Python Basics Book</a>
<a class="dropdown-item" href="/products/python-tricks-book/">Python Tricks Book</a>
<a class="dropdown-item" href="/products/cpython-internals-book/">CPython Internals Book</a>
<a class="dropdown-item" href="/products/real-python-course/">The Real Python Course</a>
<a class="dropdown-item" href="/products/managing-python-dependencies/">Managing Python Dependencies</a>
<a class="dropdown-item" href="/products/sublime-python/">Sublime Text + Python Setup</a>
<a class="dropdown-item" href="/products/pythonic-wallpapers/">Pythonic Wallpapers Pack</a>
<a class="dropdown-item" href="https://nerdlettering.com" target="_blank">Python Mugs, T-Shirts, and More</a>
<a class="dropdown-item" href="https://www.pythonistacafe.com" target="_blank">Pythonista Cafe Community</a>
<a class="dropdown-item border-top" href="/products/">Browse All »</a>
</div>
</li>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMore" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
More
</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdownMore">
<a class="dropdown-item" href="/newsletter/">Python Newsletter</a>
<a class="dropdown-item" href="/podcasts/rpp/">Python Podcast</a>
 <a class="dropdown-item" href="https://www.pythonjobshq.com" target="_blank">Python Job Board</a>
<a class="dropdown-item" href="/team/">Meet the Team</a>
<a class="dropdown-item" href="/write-for-us/">Become a Tutorial Author</a>
<a class="dropdown-item" href="/become-an-instructor/">Become a Video Instructor</a>
</div>
</li>
</ul>
<div class="d-block d-xl-none">
<ul class="navbar-nav">
<li class="nav-item">
<a class="nav-link" href="/search" title="Search"><span class="d-block d-lg-none"><i class="fa fa-search" aria-hidden="true"></i> Search</span><span class="d-none d-lg-block"><i class="fa fa-search" aria-hidden="true"></i></span></a>
</li>
</ul>
</div>
<div class="d-none d-xl-flex align-items-center mr-2">
<form class="form-inline" action="/search" method="GET">
<a class="js-search-form-submit position-absolute" href="/search" title="Search"><i class="fa fa-search fa-fw text-muted pl-2" aria-hidden="true"></i></a>
<input class="search-field form-control form-control-md mr-sm-1 mr-lg-2 w-100" style="padding-left: 2rem;" maxlength=50 type="search" placeholder="Search" aria-label="Search" name="q">
<input type="hidden" name="_from" value="nav">
</form>
</div>
<ul class="navbar-nav">
<li class="nav-item form-inline">
<a class="ml-2 ml-lg-0 btn btn-sm btn-primary px-3" href="/account/join/">Join</a>
</li>
<li class="nav-item">
<a class="btn text-light" href="/account/login/?next=%2Fdocumenting-python-code%2F">Sign&#8209;In</a>
</li>
</ul>
</div>
</div>
</nav>
<div class="container main-content">
<div class="row justify-content-center">
<div class="col-md-11 col-lg-8 article with-headerlinks">
<figure class="embed-responsive embed-responsive-16by9">
<img class="card-img-top m-0 p-0 embed-responsive-item rounded" style="object-fit: contain;" alt="Documenting Python Code Guide" src="https://files.realpython.com/media/Documenting-Python-Code_Watermarked.0b26408a1b7f.jpg" width="1920" height="1080" srcset="https://robocrop.realpython.net/?url=https%3A//files.realpython.com/media/Documenting-Python-Code_Watermarked.0b26408a1b7f.jpg&amp;w=480&amp;sig=63ac576759b8337caffd24b604d4b30816185da5 480w, https://robocrop.realpython.net/?url=https%3A//files.realpython.com/media/Documenting-Python-Code_Watermarked.0b26408a1b7f.jpg&amp;w=960&amp;sig=32281a39228075d1651274605464a6b6cf021fe4 960w, https://files.realpython.com/media/Documenting-Python-Code_Watermarked.0b26408a1b7f.jpg 1920w" sizes="75vw">
</figure>
<h1>Documenting Python Code: A Complete Guide</h1>
<div class="mb-0">
<span class="text-muted">by <a class="text-muted" href="#author">James Mertz</a>
<span class="ml-2 mr-1 fa fa-comments"></span><a class="text-muted" href="#reader-comments"><span class="disqus-comment-count" data-disqus-identifier="https://realpython.com/documenting-python-code/"></span></a>
<span class="ml-2 fa fa-tags" aria-hidden="true"></span>
<a href="/tutorials/best-practices/" class="badge badge-light text-muted">best-practices</a>
<a href="/tutorials/intermediate/" class="badge badge-light text-muted">intermediate</a>
<a href="/tutorials/python/" class="badge badge-light text-muted">python</a>
<div class="d-sm-flex flex-row justify-content-between my-3 text-center">
<div class="jsCompletionStatusWidget btn-group mb-0">
<button title="Click to mark as completed" class="jsBtnCompletion btn btn-secondary border-right " style="border-top-right-radius: 0; border-bottom-right-radius: 0;" disabled>Mark as Completed</button>
<button title="Add bookmark" class="jsBtnBookmark btn btn-secondary border-left" disabled><i class="fa fa-fw fa-bookmark-o"></i></button>
</div>

<div class="align-self-center my-2">
<span>
<a target="_blank" rel="nofollow" href="https://twitter.com/intent/tweet/?text=Check out this %23Python tutorial: Documenting%20Python%20Code%3A%20A%20Complete%20Guide by @realpython&url=https%3A//realpython.com/documenting-python-code/" class="mr-1 badge badge-twitter text-light mb-1"><i class="mr-1 fa fa-twitter text-light"></i>Tweet</a>
<a target="_blank" rel="nofollow" href="https://facebook.com/sharer/sharer.php?u=https%3A//realpython.com/documenting-python-code/" class="mr-1 badge badge-facebook text-light mb-1"><i class="mr-1 fa fa-facebook text-light"></i>Share</a>
<a target="_blank" rel="nofollow" href="mailto:?subject=Python article for you&body=Check out this Python tutorial:%0A%0ADocumenting%20Python%20Code%3A%20A%20Complete%20Guide%0A%0Ahttps%3A//realpython.com/documenting-python-code/" class="badge badge-red text-light mb-1"><i class="mr-1 fa fa-envelope text-light"></i>Email</a>
</span>
</div>
</div>
</div>
<div class="article-body">
<div class="bg-light sidebar-module sidebar-module-inset" id="toc">
<p class="h3 mb-2 text-muted">Table of Contents</p>
<div class="toc">
<ul>
<li><a href="#why-documenting-your-code-is-so-important">Why Documenting Your Code Is So Important</a></li>
<li><a href="#commenting-vs-documenting-code">Commenting vs Documenting Code</a><ul>
<li><a href="#basics-of-commenting-code">Basics of Commenting Code</a></li>
<li><a href="#commenting-code-via-type-hinting-python-35">Commenting Code via Type Hinting (Python 3.5+)</a></li>
</ul>
</li>
<li><a href="#documenting-your-python-code-base-using-docstrings">Documenting Your Python Code Base Using Docstrings</a><ul>
<li><a href="#docstrings-background">Docstrings Background</a></li>
<li><a href="#docstring-types">Docstring Types</a></li>
<li><a href="#docstring-formats">Docstring Formats</a></li>
</ul>
</li>
<li><a href="#documenting-your-python-projects">Documenting Your Python Projects</a><ul>
<li><a href="#private-projects">Private Projects</a></li>
<li><a href="#shared-projects">Shared Projects</a></li>
<li><a href="#public-and-open-source-projects">Public and Open Source Projects</a></li>
<li><a href="#documentation-tools-and-resources">Documentation Tools and Resources</a></li>
</ul>
</li>
<li><a href="#where-do-i-start">Where Do I Start?</a></li>
</ul>
</div>
</div>
<div class="sidebar-module sidebar-module-inset p-0" style="overflow:hidden;">
<div style="display:block;position:relative;">
<div style="display:block;width:100%;padding-top:12.5%;"></div>
<div class="rpad rounded border" data-unit="8x1" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;"></div>
</div>
<a class="small text-muted" href="/account/join/" rel="nofollow"> <i class="fa fa-info-circle" aria-hidden="true"> </i> Remove ads</a>
</div>
<div class="border rounded p-3 card mb-2">
<p class="mb-0"><span class="badge badge-pill badge-success"><i class="fa fa-play-circle" aria-hidden="true"></i> Watch Now</span> This tutorial has a related video course created by the Real Python team. Watch it together with the written tutorial to deepen your understanding: <a class="stretched-link text-success" href="/courses/documenting-python-code/"><strong>Documenting Python Code: A Complete Guide</strong></a></p>
</div>
<p>Welcome to your complete guide to documenting Python code. Whether you&rsquo;re documenting a small script or a large project, whether you&rsquo;re a <a href="https://realpython.com/python-beginner-tips/">beginner</a> or a seasoned Pythonista, this guide will cover everything you need to know.</p>
<p>We&rsquo;ve broken up this tutorial into four major sections:</p>
<ol>
<li><strong><a href="#why-documenting-your-code-is-so-important">Why Documenting Your Code Is So Important</a>:</strong> An introduction to documentation and its importance</li>
<li><strong><a href="#commenting-vs-documenting-code">Commenting vs Documenting Code</a>:</strong> An overview of the major differences between commenting and documenting, as well as the appropriate times and ways to use commenting</li>
<li><strong><a href="#documenting-your-python-code-base-using-docstrings">Documenting Your Python Code Base Using Docstrings</a>:</strong> A deep dive into docstrings for classes, class methods, functions, modules, packages, and scripts, as well as what should be found within each one</li>
<li><strong><a href="#documenting-your-python-projects">Documenting Your Python Projects</a>:</strong> The necessary elements and what they should contain for your Python projects</li>
</ol>
<p>Feel free to read through this tutorial from beginning to end or jump to a section you&rsquo;re interested in. It was designed to work both ways.</p>
<section class="section2" id="why-documenting-your-code-is-so-important"><h2>Why Documenting Your Code Is So Important<a class="headerlink" href="#why-documenting-your-code-is-so-important" title="Permanent link"></a></h2>
<p>Hopefully, if you&rsquo;re reading this tutorial, you already know the importance of documenting your code. But if not, then let me quote something Guido mentioned to me at a recent PyCon:</p>
<blockquote>
<p>&ldquo;Code is more often read than written.&rdquo;</p>
<p>&mdash; <em>Guido van Rossum</em></p>
</blockquote>
<p>When you write code, you write it for two primary audiences: your users and your developers (including yourself). Both audiences are equally important. If you&rsquo;re like me, you&rsquo;ve probably opened up old codebases and wondered to yourself, &ldquo;What in the world was I thinking?&rdquo; If you&rsquo;re having a problem reading your own code, imagine what your users or other developers are experiencing when they&rsquo;re trying to use or <a href="https://realpython.com/start-contributing-python/">contribute</a> to your code.</p>
<p>Conversely, I&rsquo;m sure you&rsquo;ve run into a situation where you wanted to do something in Python and found what looks like a great library that can get the job done. However, when you start using the library, you look for examples, write-ups, or even official documentation on how to do something specific and can&rsquo;t immediately find the solution.</p>
<p>After searching, you come to realize that the documentation is lacking or even worse, missing entirely. This is a frustrating feeling that deters you from using the library, no matter how great or efficient the code is. Daniele Procida summarized this situation best:</p>
<blockquote>
<p>&ldquo;It doesn&rsquo;t matter how good your software is, because <strong>if the documentation is not good enough, people will not use it.</strong>&ldquo;</p>
<p>&mdash; <em><a href="https://www.divio.com/en/blog/documentation/">Daniele Procida</a></em></p>
</blockquote>
<p>In this guide, you&rsquo;ll learn from the ground up how to properly document your Python code from the smallest of scripts to the largest of <a href="https://realpython.com/intermediate-python-project-ideas/">Python projects</a> to help prevent your users from ever feeling too frustrated to use or contribute to your project.</p>
<div><div class="rounded border border-light" style="display:block;position:relative;"><div style="display:block;width:100%;padding-top:12.5%;"></div><div class="rpad rounded border" data-unit="8x1" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;"></div></div><a class="small text-muted" href="/account/join/" rel="nofollow"><i aria-hidden="true" class="fa fa-info-circle"> </i> Remove ads</a></div></section><section class="section2" id="commenting-vs-documenting-code"><h2>Commenting vs Documenting Code<a class="headerlink" href="#commenting-vs-documenting-code" title="Permanent link"></a></h2>
<p>Before we can go into how to document your Python code, we need to distinguish documenting from commenting.</p>
<p>In general, commenting is describing your code to/for developers. The intended main audience is the maintainers and developers of the Python code. In conjunction with well-written code, comments help to guide the reader to better understand your code and its purpose and design:</p>
<blockquote>
<p>&ldquo;Code tells you how; Comments tell you why.&rdquo;</p>
<p>&mdash; <em><a href="https://blog.codinghorror.com/code-tells-you-how-comments-tell-you-why/">Jeff Atwood</a> (aka Coding Horror)</em></p>
</blockquote>
<p>Documenting code is describing its use and functionality to your users. While it may be helpful in the development process, the main intended audience is the users. The following section describes how and when to comment your code.</p>
<section class="section3" id="basics-of-commenting-code"><h3>Basics of Commenting Code<a class="headerlink" href="#basics-of-commenting-code" title="Permanent link"></a></h3>
<p>Comments are created in Python using the pound sign (<code>#</code>) and should be brief statements no longer than a few sentences. Here&rsquo;s a simple example:</p>
<div class="highlight python"><pre><span></span><code><span class="k">def</span> <span class="nf">hello_world</span><span class="p">():</span>
    <span class="c1"># A simple comment preceding a simple print statement</span>
    <span class="nb">print</span><span class="p">(</span><span class="s2">&quot;Hello World&quot;</span><span class="p">)</span>
</code></pre></div>
<p>According to <a href="http://pep8.org/#maximum-line-length">PEP 8</a>, comments should have a maximum length of 72 characters. This is true even if your project changes the max line length to be greater than the recommended 80 characters. If a comment is going to be greater than the comment char limit, using multiple lines for the comment is appropriate:</p>
<div class="highlight python"><pre><span></span><code><span class="k">def</span> <span class="nf">hello_long_world</span><span class="p">():</span>
    <span class="c1"># A very long statement that just goes on and on and on and on and</span>
    <span class="c1"># never ends until after it&#39;s reached the 80 char limit</span>
    <span class="nb">print</span><span class="p">(</span><span class="s2">&quot;Hellooooooooooooooooooooooooooooooooooooooooooooooooooooooo World&quot;</span><span class="p">)</span>
</code></pre></div>
<p>Commenting your code serves <a href="https://en.wikipedia.org/wiki/Comment_(computer_programming)#Uses">multiple purposes, including</a>:</p>
<ul>
<li>
<p><strong>Planning and Reviewing:</strong> When you are developing new portions of your code, it may be appropriate to first use comments as a way of planning or outlining that section of code. Remember to remove these comments once the actual coding has been implemented and reviewed/tested:</p>
<div class="highlight python"><pre><span></span><code><span class="c1"># First step</span>
<span class="c1"># Second step</span>
<span class="c1"># Third step</span>
</code></pre></div>
</li>
<li>
<p><strong>Code Description:</strong> Comments can be used to explain the intent of specific sections of code:</p>
<div class="highlight python"><pre><span></span><code><span class="c1"># Attempt a connection based on previous settings. If unsuccessful,</span>
<span class="c1"># prompt user for new settings.</span>
</code></pre></div>
</li>
<li>
<p><strong>Algorithmic Description:</strong> When algorithms are used, especially complicated ones, it can be useful to explain how the algorithm works or how it&rsquo;s implemented within your code. It may also be appropriate to describe why a specific algorithm was selected over another.</p>
<div class="highlight python"><pre><span></span><code><span class="c1"># Using quick sort for performance gains</span>
</code></pre></div>
</li>
<li>
<p><strong>Tagging:</strong> The use of tagging can be used to label specific sections of code where known issues or areas of improvement are located. Some examples are: <code>BUG</code>, <code>FIXME</code>, and <code>TODO</code>.</p>
<div class="highlight python"><pre><span></span><code><span class="c1"># TODO: Add condition for when val is None</span>
</code></pre></div>
</li>
</ul>
<p>Comments to your code should be kept brief and focused. Avoid using long comments when possible. Additionally, you should use the following four essential rules as <a href="https://blog.codinghorror.com/when-good-comments-go-bad/">suggested by Jeff Atwood</a>:</p>
<ol>
<li>
<p>Keep comments as close to the code being described as possible. Comments that aren&rsquo;t near their describing code are frustrating to the reader and easily missed when updates are made.</p>
</li>
<li>
<p>Don&rsquo;t use complex formatting (such as tables or ASCII figures). Complex formatting leads to distracting content and can be difficult to maintain over time.</p>
</li>
<li>
<p>Don&rsquo;t include redundant information. Assume the reader of the code has a basic understanding of programming principles and language syntax.</p>
</li>
<li>
<p>Design your code to comment itself. The easiest way to understand code is by reading it. When you design your code using clear, easy-to-understand concepts, the reader will be able to quickly conceptualize your intent.</p>
</li>
</ol>
<p>Remember that comments are designed for the reader, including yourself, to help guide them in understanding the purpose and design of the software.</p>
</section><section class="section3" id="commenting-code-via-type-hinting-python-35"><h3>Commenting Code via Type Hinting (Python 3.5+)<a class="headerlink" href="#commenting-code-via-type-hinting-python-35" title="Permanent link"></a></h3>
<p>Type hinting was added to Python 3.5 and is an additional form to help the readers of your code. In fact, it takes Jeff&rsquo;s fourth suggestion from above to the next level. It allows the developer to design and explain portions of their code without commenting. Here&rsquo;s a quick example:</p>
<div class="highlight python"><pre><span></span><code><span class="k">def</span> <span class="nf">hello_name</span><span class="p">(</span><span class="n">name</span><span class="p">:</span> <span class="nb">str</span><span class="p">)</span> <span class="o">-&gt;</span> <span class="nb">str</span><span class="p">:</span>
    <span class="k">return</span><span class="p">(</span><span class="sa">f</span><span class="s2">&quot;Hello </span><span class="si">{</span><span class="n">name</span><span class="si">}</span><span class="s2">&quot;</span><span class="p">)</span>
</code></pre></div>
<p>From examining the type hinting, you can immediately tell that the function expects the input <code>name</code> to be of a type <code>str</code>, or <a href="https://realpython.com/python-strings/">string</a>. You can also tell that the expected output of the function will be of a type <code>str</code>, or string, as well. While type hinting helps reduce comments, take into consideration that doing so may also make extra work when you are creating or updating your project documentation.</p>
<p>You can learn more about type hinting and type checking from <a href="https://www.youtube.com/watch?v=2xWhaALHTvU">this video created by Dan Bader</a>.</p>
<div><div class="rounded border border-light" style="display:block;position:relative;"><div style="display:block;width:100%;padding-top:12.5%;"></div><div class="rpad rounded border" data-unit="8x1" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;"></div></div><a class="small text-muted" href="/account/join/" rel="nofollow"><i aria-hidden="true" class="fa fa-info-circle"> </i> Remove ads</a></div></section></section><section class="section2" id="documenting-your-python-code-base-using-docstrings"><h2>Documenting Your Python Code Base Using Docstrings<a class="headerlink" href="#documenting-your-python-code-base-using-docstrings" title="Permanent link"></a></h2>
<p>Now that we&rsquo;ve learned about commenting, let&rsquo;s take a deep dive into documenting a Python code base. In this section, you&rsquo;ll learn about docstrings and how to use them for documentation. This section is further divided into the following sub-sections:</p>
<ol>
<li><strong><a href="#docstrings-background">Docstrings Background</a>:</strong> A background on how docstrings work internally within Python</li>
<li><strong><a href="#docstring-types">Docstring Types</a>:</strong> The various docstring &ldquo;types&rdquo; (function, class, class method, <a href="https://realpython.com/python-modules-packages/">module, package</a>, and script)</li>
<li><strong><a href="#docstring-formats">Docstring Formats</a>:</strong> The different docstring &ldquo;formats&rdquo; (Google, NumPy/SciPy, reStructuredText, and Epytext)</li>
</ol>
<section class="section3" id="docstrings-background"><h3>Docstrings Background<a class="headerlink" href="#docstrings-background" title="Permanent link"></a></h3>
<p>Documenting your Python code is all centered on docstrings. These are built-in strings that, when configured correctly, can help your users and yourself with your project&rsquo;s documentation. Along with docstrings, Python also has the built-in function <code>help()</code> that prints out the objects docstring to the console. Here&rsquo;s a quick example:</p>
<div class="highlight python repl"><span class="repl-toggle" title="Toggle REPL prompts and output">&gt;&gt;&gt;</span><pre><span></span><code><span class="gp">&gt;&gt;&gt; </span><span class="n">help</span><span class="p">(</span><span class="nb">str</span><span class="p">)</span>
<span class="go">Help on class str in module builtins:</span>

<span class="go">class str(object)</span>
<span class="go"> |  str(object=&#39;&#39;) -&gt; str</span>
<span class="go"> |  str(bytes_or_buffer[, encoding[, errors]]) -&gt; str</span>
<span class="go"> |</span>
<span class="go"> |  Create a new string object from the given object. If encoding or</span>
<span class="go"> |  errors are specified, then the object must expose a data buffer</span>
<span class="go"> |  that will be decoded using the given encoding and error handler.</span>
<span class="go"> |  Otherwise, returns the result of object.__str__() (if defined)</span>
<span class="go"> |  or repr(object).</span>
<span class="go"> |  encoding defaults to sys.getdefaultencoding().</span>
<span class="go"> |  errors defaults to &#39;strict&#39;.</span>
<span class="go"> # Truncated for readability</span>
</code></pre></div>
<p>How is this output generated? Since everything in Python is an object, you can examine the directory of the object using the <code>dir()</code> command. Let&rsquo;s do that and see what find:</p>
<div class="highlight python repl"><span class="repl-toggle" title="Toggle REPL prompts and output">&gt;&gt;&gt;</span><pre><span></span><code><span class="gp">&gt;&gt;&gt; </span><span class="nb">dir</span><span class="p">(</span><span class="nb">str</span><span class="p">)</span>
<span class="go">[&#39;__add__&#39;, ..., &#39;__doc__&#39;, ..., &#39;zfill&#39;] # Truncated for readability</span>
</code></pre></div>
<p>Within that directory output, there&rsquo;s an interesting property, <code>__doc__</code>. If you examine that property, you&rsquo;ll discover this:</p>
<div class="highlight python repl"><span class="repl-toggle" title="Toggle REPL prompts and output">&gt;&gt;&gt;</span><pre><span></span><code><span class="gp">&gt;&gt;&gt; </span><span class="nb">print</span><span class="p">(</span><span class="nb">str</span><span class="o">.</span><span class="vm">__doc__</span><span class="p">)</span>
<span class="go">str(object=&#39;&#39;) -&gt; str</span>
<span class="go">str(bytes_or_buffer[, encoding[, errors]]) -&gt; str</span>

<span class="go">Create a new string object from the given object. If encoding or</span>
<span class="go">errors are specified, then the object must expose a data buffer</span>
<span class="go">that will be decoded using the given encoding and error handler.</span>
<span class="go">Otherwise, returns the result of object.__str__() (if defined)</span>
<span class="go">or repr(object).</span>
<span class="go">encoding defaults to sys.getdefaultencoding().</span>
<span class="go">errors defaults to &#39;strict&#39;.</span>
</code></pre></div>
<p>Voilà! You&rsquo;ve found where docstrings are stored within the object. This means that you can directly manipulate that property. However, there are restrictions for builtins:</p>
<div class="highlight python repl"><span class="repl-toggle" title="Toggle REPL prompts and output">&gt;&gt;&gt;</span><pre><span></span><code><span class="gp">&gt;&gt;&gt; </span><span class="nb">str</span><span class="o">.</span><span class="vm">__doc__</span> <span class="o">=</span> <span class="s2">&quot;I&#39;m a little string doc! Short and stout; here is my input and print me for my out&quot;</span>
<span class="gt">Traceback (most recent call last):</span>
  File <span class="nb">&quot;&lt;stdin&gt;&quot;</span>, line <span class="m">1</span>, in <span class="n">&lt;module&gt;</span>
<span class="gr">Type
2a93
Error</span>: <span class="n">can&#39;t set attributes of built-in/extension type &#39;str&#39;</span>
</code></pre></div>
<p>Any other custom object can be manipulated:</p>
<div class="highlight python"><pre><span></span><code><span class="k">def</span> <span class="nf">say_hello</span><span class="p">(</span><span class="n">name</span><span class="p">):</span>
    <span class="nb">print</span><span class="p">(</span><span class="sa">f</span><span class="s2">&quot;Hello </span><span class="si">{</span><span class="n">name</span><span class="si">}</span><span class="s2">, is it me you&#39;re looking for?&quot;</span><span class="p">)</span>

<span class="n">say_hello</span><span class="o">.</span><span class="vm">__doc__</span> <span class="o">=</span> <span class="s2">&quot;A simple function that says hello... Richie style&quot;</span>
</code></pre></div>
<div class="highlight python repl"><span class="repl-toggle" title="Toggle REPL prompts and output">&gt;&gt;&gt;</span><pre><span></span><code><span class="gp">&gt;&gt;&gt; </span><span class="n">help</span><span class="p">(</span><span class="n">say_hello</span><span class="p">)</span>
<span class="go">Help on function say_hello in module __main__:</span>

<span class="go">say_hello(name)</span>
<span class="go">    A simple function that says hello... Richie style</span>
</code></pre></div>
<p>Python has one more feature that simplifies docstring creation. Instead of directly manipulating the <code>__doc__</code> property, the strategic placement of the string literal directly below the object will automatically set the <code>__doc__</code> value. Here&rsquo;s what happens with the same example as above:</p>
<div class="highlight python"><pre><span></span><code><span class="k">def</span> <span class="nf">say_hello</span><span class="p">(</span><span class="n">name</span><span class="p">):</span>
    <span class="sd">&quot;&quot;&quot;A simple function that says hello... Richie style&quot;&quot;&quot;</span>
    <span class="nb">print</span><span class="p">(</span><span class="sa">f</span><span class="s2">&quot;Hello </span><span class="si">{</span><span class="n">name</span><span class="si">}</span><span class="s2">, is it me you&#39;re looking for?&quot;</span><span class="p">)</span>
</code></pre></div>
<div class="highlight python repl"><span class="repl-toggle" title="Toggle REPL prompts and output">&gt;&gt;&gt;</span><pre><span></span><code><span class="gp">&gt;&gt;&gt; </span><span class="n">help</span><span class="p">(</span><span class="n">say_hello</span><span class="p">)</span>
<span class="go">Help on function say_hello in module __main__:</span>

<span class="go">say_hello(name)</span>
<span class="go">    A simple function that says hello... Richie style</span>
</code></pre></div>
<p>There you go! Now you understand the background of docstrings. Now it&rsquo;s time to learn about the different types of docstrings and what information they should contain.</p>
</section><section class="section3" id="docstring-types"><h3>Docstring Types<a class="headerlink" href="#docstring-types" title="Permanent link"></a></h3>
<p>Docstring conventions are described within <a href="https://www.python.org/dev/peps/pep-0257/">PEP 257</a>. Their purpose is to provide your users with a brief overview of the object. They should be kept concise enough to be easy to maintain but still be elaborate enough for new users to understand their purpose and how to use the documented object.</p>
<p>In all cases, the docstrings should use the triple-double quote (<code>"""</code>) string format. This should be done whether the docstring is multi-lined or not. At a bare minimum, a docstring should be a quick summary of whatever is it you&rsquo;re describing and should be contained within a single line:</p>
<div class="highlight python"><pre><span></span><code><span class="sd">&quot;&quot;&quot;This is a quick summary line used as a description of the object.&quot;&quot;&quot;</span>
</code></pre></div>
<p>Multi-lined docstrings are used to further elaborate on the object beyond the summary. All multi-lined docstrings have the following parts:</p>
<ul>
<li>A one-line summary line</li>
<li>A blank line proceeding the summary</li>
<li>Any further elaboration for the docstring</li>
<li>Another blank line</li>
</ul>
<div class="highlight python"><pre><span></span><code><span class="sd">&quot;&quot;&quot;This is the summary line</span>

<span class="sd">This is the further elaboration of the docstring. Within this section,</span>
<span class="sd">you can elaborate further on details as appropriate for the situation.</span>
<span class="sd">Notice that the summary and the elaboration is separated by a blank new</span>
<span class="sd">line.</span>
<span class="sd">&quot;&quot;&quot;</span>

<span class="c1"># Notice the blank line above. Code should continue on this line.</span>
</code></pre></div>
<p>All docstrings should have the same max character length as comments (72 characters). Docstrings can be further broken up into three major categories:</p>
<ul>
<li><strong>Class Docstrings:</strong> Class and class methods</li>
<li><strong>Package and Module Docstrings:</strong> Package, modules, and functions</li>
<li><strong>Script Docstrings:</strong> Script and functions</li>
</ul>
<section class="section4" id="class-docstrings"><h4>Class Docstrings<a class="headerlink" href="#class-docstrings" title="Permanent link"></a></h4>
<p>Class Docstrings are created for the class itself, as well as any class methods. The docstrings are placed immediately following the class or class method indented by one level:</p>
<div class="highlight python"><pre><span></span><code><span class="k">class</span> <span class="nc">SimpleClass</span><span class="p">:</span>
    <span class="sd">&quot;&quot;&quot;Class docstrings go here.&quot;&quot;&quot;</span>

    <span class="k">def</span> <span class="nf">say_hello</span><span class="p">(</span><span class="bp">self</span><span class="p">,</span> <span class="n">name</span><span class="p">:</span> <span class="nb">str</span><span class="p">):</span>
        <span class="sd">&quot;&quot;&quot;Class method docstrings go here.&quot;&quot;&quot;</span>

        <span class="nb">print</span><span class="p">(</span><span class="sa">f</span><span class="s1">&#39;Hello </span><span class="si">{</span><span class="n">name</span><span class="si">}</span><span class="s1">&#39;</span><span class="p">)</span>
</code></pre></div>
<p>Class docstrings should contain the following information:</p>
<ul>
<li>A brief summary of its purpose and behavior</li>
<li>Any public methods, along with a brief description</li>
<li>Any class properties (attributes)</li>
<li>Anything related to the <a href="https://realpython.com/python-interface/">interface</a> for subclassers, if the class is intended to be subclassed </li>
</ul>
<p>The <a href="https://realpython.com/python-class-constructor/">class constructor</a> parameters should be documented within the <code>__init__</code> class method docstring. Individual methods should be documented using their individual docstrings. Class method docstrings should contain the following:</p>
<ul>
<li>A brief description of what the method is and what it&rsquo;s used for</li>
<li>Any arguments (both required and optional) that are passed including keyword arguments</li>
<li>Label any arguments that are considered optional or have a default value</li>
<li>Any side effects that occur when executing the method</li>
<li>Any exceptions that are raised</li>
<li>Any restrictions on when the method can be called</li>
</ul>
<p>Let&rsquo;s take a simple example of a data class that represents an Animal. This class will contain a few class properties, instance properties, a <code>__init__</code>, and a single <a href="https://realpython.com/instance-class-and-static-methods-demystified/">instance method</a>:</p>
<div class="highlight python"><pre><span></span><code><span class="k">class</span> <span class="nc">Animal</span><span class="p">:</span>
    <span class="sd">&quot;&quot;&quot;</span>
<span class="sd">    A class used to represent an Animal</span>

<span class="sd">    ...</span>

<span class="sd">    Attributes</span>
<span class="sd">    ----------</span>
<span class="sd">    says_str : str</span>
<span class="sd">        a formatted string to print out what the animal says</span>
<span class="sd">    name : str</span>
<span class="sd">        the name of the animal</span>
<span class="sd">    sound : str</span>
<span class="sd">        the sound that the animal makes</span>
<span class="sd">    num_legs : int</span>
<span class="sd">        the number of legs the animal has (default 4)</span>

<span class="sd">    Methods</span>
<span class="sd">    -------</span>
<span class="sd">    says(sound=None)</span>
<span class="sd">        Prints the animals name and what sound it makes</span>
<span class="sd">    &quot;&quot;&quot;</span>

    <span class="n">says_str</span> <span class="o">=</span> <span class="s2">&quot;A </span><span class="si">{name}</span><span class="s2"> says </span><span class="si">{sound}</span><span class="s2">&quot;</span>

    <span class="k">def</span> <span class="fm">__init__</span><span class="p">(</span><span class="bp">self</span><span class="p">,</span> <span class="n">name</span><span class="p">,</span> <span class="n">sound</span><span class="p">,</span> <span class="n">num_legs</span><span class="o">=</span><span class="mi">4</span><span class="p">):</span>
        <span class="sd">&quot;&quot;&quot;</span>
<span class="sd">        Parameters</span>
<span class="sd">        ----------</span>
<span class="sd">        name : str</span>
<span class="sd">            The name of the animal</span>
<span class="sd">        sound : str</span>
<span class="sd">            The sound the animal makes</span>
<span class="sd">        num_legs : int, optional</span>
<span class="sd">            The number of legs the animal (default is 4)</span>
<span class="sd">        &quot;&quot;&quot;</span>

        <span class="bp">self</span><span class="o">.</span><span class="n">name</span> <span class="o">=</span> <span class="n">name</span>
        <span class="bp">self</span><span class="o">.</span><span class="n">sound</span> <span class="o">=</span> <span class="n">sound</span>
        <span class="bp">self</span><span class="o">.</span><span class="n">num_legs</span> <span class="o">=</span> <span class="n">num_legs</span>

    <span class="k">def</span> <span class="nf">says</span><span class="p">(</span><span class="bp">self</span><span class="p">,</span> <span class="n">sound</span><span class="o">=</span><span class="kc">None</span><span class="p">):</span>
        <span class="sd">&quot;&quot;&quot;Prints what the animals name is and what sound it makes.</span>

<span class="sd">        If the argument
7ffa
 `sound` isn&#39;t passed in, the default Animal</span>
<span class="sd">        sound is used.</span>

<span class="sd">        Parameters</span>
<span class="sd">        ----------</span>
<span class="sd">        sound : str, optional</span>
<span class="sd">            The sound the animal makes (default is None)</span>

<span class="sd">        Raises</span>
<span class="sd">        ------</span>
<span class="sd">        NotImplementedError</span>
<span class="sd">            If no sound is set for the animal or passed in as a</span>
<span class="sd">            parameter.</span>
<span class="sd">        &quot;&quot;&quot;</span>

        <span class="k">if</span> <span class="bp">self</span><span class="o">.</span><span class="n">sound</span> <span class="ow">is</span> <span class="kc">None</span> <span class="ow">and</span> <span class="n">sound</span> <span class="ow">is</span> <span class="kc">None</span><span class="p">:</span>
            <span class="k">raise</span> <span class="ne">NotImplementedError</span><span class="p">(</span><span class="s2">&quot;Silent Animals are not supported!&quot;</span><span class="p">)</span>

        <span class="n">out_sound</span> <span class="o">=</span> <span class="bp">self</span><span class="o">.</span><span class="n">sound</span> <span class="k">if</span> <span class="n">sound</span> <span class="ow">is</span> <span class="kc">None</span> <span class="k">else</span> <span class="n">sound</span>
        <span class="nb">print</span><span class="p">(</span><span class="bp">self</span><span class="o">.</span><span class="n">says_str</span><span class="o">.</span><span class="n">format</span><span class="p">(</span><span class="n">name</span><span class="o">=</span><span class="bp">self</span><span class="o">.</span><span class="n">name</span><span class="p">,</span> <span class="n">sound</span><span class="o">=</span><span class="n">out_sound</span><span class="p">))</span>
</code></pre></div>
</section><section class="section4" id="package-and-module-docstrings"><h4>Package and Module Docstrings<a class="headerlink" href="#package-and-module-docstrings" title="Permanent link"></a></h4>
<p>Package docstrings should be placed at the top of the package&rsquo;s <code>__init__.py</code> file. This docstring should list the modules and sub-packages that are exported by the package.</p>
<p>Module docstrings are similar to class docstrings. Instead of classes and class methods being documented, it&rsquo;s now the module and any functions found within. Module docstrings are placed at the top of the file even before any imports. Module docstrings should include the following:</p>
<ul>
<li>A brief description of the module and its purpose</li>
<li>A list of any classes, exception, functions, and any other objects exported by the module</li>
</ul>
<p>The docstring for a module function should include the same items as a class method:</p>
<ul>
<li>A brief description of what the function is and what it&rsquo;s used for</li>
<li>Any arguments (both required and optional) that are passed including keyword arguments</li>
<li>Label any arguments that are considered optional</li>
<li>Any side effects that occur when executing the function</li>
<li>Any exceptions that are raised</li>
<li>Any restrictions on when the function can be called</li>
</ul>
</section><section class="section4" id="script-docstrings"><h4>Script Docstrings<a class="headerlink" href="#script-docstrings" title="Permanent link"></a></h4>
<p>Scripts are considered to be single file executables run from the console. Docstrings for scripts are placed at the top of the file and should be documented well enough for users to be able to have a sufficient understanding of how to use the script. It should be usable for its &ldquo;usage&rdquo; message, when the user incorrectly passes in a parameter or uses the <code>-h</code> option.</p>
<p>If you use <code>argparse</code>, then you can omit parameter-specific documentation, assuming it&rsquo;s correctly been documented within the <code>help</code> parameter of the <code>argparser.parser.add_argument</code> function. It is recommended to use the <code>__doc__</code> for the <code>description</code> parameter within <code>argparse.ArgumentParser</code>&rsquo;s constructor. Check out our tutorial on <a href="https://realpython.com/comparing-python-command-line-parsing-libraries-argparse-docopt-click/">Command-Line Parsing Libraries</a> for more details on how to use <code>argparse</code> and other common command line parsers.</p>
<p>Finally, any custom or third-party imports should be listed within the docstrings to allow users to know which packages may be required for running the script. Here&rsquo;s an example of a script that is used to simply print out the column headers of a spreadsheet:</p>
<div class="highlight python"><pre><span></span><code><span class="sd">&quot;&quot;&quot;Spreadsheet Column Printer</span>

<span class="sd">This script allows the user to print to the console all columns in the</span>
<span class="sd">spreadsheet. It is assumed that the first row of the spreadsheet is the</span>
<span class="sd">location of the columns.</span>

<span class="sd">This tool accepts comma separated value files (.csv) as well as excel</span>
<span class="sd">(.xls, .xlsx) files.</span>

<span class="sd">This script requires that `pandas` be installed within the Python</span>
<span class="sd">environment you are running this script in.</span>

<span class="sd">This file can also be imported as a module and contains the following</span>
<span class="sd">functions:</span>

<span class="sd">    * get_spreadsheet_cols - returns the column headers of the file</span>
<span class="sd">    * main - the main function of the script</span>
<span class="sd">&quot;&quot;&quot;</span>

<span class="kn">import</span> <span class="nn">argparse</span>

<span class="kn">import</span> <span class="nn">pandas</span> <span class="k">as</span> <span class="nn">pd</span>


<span class="k">def</span> <span class="nf">get_spreadsheet_cols</span><span class="p">(</span><span class="n">file_loc</span><span class="p">,</span> <span class="n">print_cols</span><span class="o">=</span><span class="kc">False</span><span class="p">):</span>
    <span class="sd">&quot;&quot;&quot;Gets and prints the spreadsheet&#39;s header columns</span>

<span class="sd">    Parameters</span>
<span class="sd">    ----------</span>
<span class="sd">    file_loc : str</span>
<span class="sd">        The file location of the spreadsheet</span>
<span class="sd">    print_cols : bool, optional</span>
<span class="sd">        A flag used to print the columns to the console (default is</span>
<span class="sd">        False)</span>

<span class="sd">    Returns</span>
<span class="sd">    -------</span>
<span class="sd">    list</span>
<span class="sd">        a list of strings used that are the header columns</span>
<span class="sd">    &quot;&quot;&quot;</span>

    <span class="n">file_data</span> <span class="o">=</span> <span class="n">pd</span><span class="o">.</span><span class="n">read_excel</span><span class="p">(</span><span class="n">file_loc</span><span class="p">)</span>
    <span class="n">col_headers</span> <span class="o">=</span> <span class="nb">list</span><span class="p">(</span><span class="n">file_data</span><span class="o">.</span><span class="n">columns</span><span class="o">.</span><span class="n">values</span><span class="p">)</span>

    <span class="k">if</span> <span class="n">print_cols</span><span class="p">:</span>
        <span class="nb">print</span><span class="p">(</span><span class="s2">&quot;</span><span class="se">\n</span><span class="s2">&quot;</span><span class="o">.</span><span class="n">join</span><span class="p">(</span><span class="n">col_headers</span><span class="p">))</span>

    <span class="k">return</span> <span class="n">col_headers</span>


<span class="k">def</span> <span class="nf">main</span><span class="p">():</span>
    <span class="n">parser</span> <span class="o">=</span> <span class="n">argparse</span><span class="o">.</span><span class="n">ArgumentParser</span><span class="p">(</span><span class="n">description</span><span class="o">=</span><span class="vm">__doc__</span><span class="p">)</span>
    <span class="n">parser</span><span class="o">.</span><span class="n">add_argument</span><span class="p">(</span>
        <span class="s1">&#39;input_file&#39;</span><span class="p">,</span>
        <span class="nb">type</span><span class="o">=</span><span class="nb">str</span><span class="p">,</span>
        <span class="n">help</span><span class="o">=</span><span class="s2">&quot;The spreadsheet file to pring the columns of&quot;</span>
    <span class="p">)</span>
    <span class="n">args</span> <span class="o">=</span> <span class="n">parser</span><span class="o">.</span><span class="n">parse_args</span><span class="p">()</span>
    <span class="n">get_spreadsheet_cols</span><span class="p">(</span><span class="n">args</span><span class="o">.</span><span class="n">input_file</span><span class="p">,</span> <span class="n">print_cols</span><span class="o">=</span><span class="kc">True</span><span class="p">)</span>


<span class="k">if</span> <span class="vm">__name__</span> <span class="o">==</span> <span class="s2">&quot;__main__&quot;</span><span class="p">:</span>
    <span class="n">main</span><span class="p">()</span>
</code></pre></div>
<div><div class="rounded border border-light" style="display:block;position:relative;"><div style="display:block;width:100%;padding-top:12.5%;"></div><div class="rpad rounded border" data-unit="8x1" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;"></div></div><a class="small text-muted" href="/account/join/" rel="nofollow"><i aria-hidden="true" class="fa fa-info-circle"> </i> Remove ads</a></div></section></section><section class="section3" id="docstring-formats"><h3>Docstring Formats<a class="headerlink" href="#docstring-formats" title="Permanent link"></a></h3>
<p>You may have noticed that, throughout the examples given in this tutorial, there has been specific formatting with common elements: <code>Arguments</code>, <code>Returns</code>, and <code>Attributes</code>. There are specific docstrings formats that can be used to help docstring parsers and users have a familiar and known format. The formatting used within the examples in this tutorial are NumPy/SciPy-style docstrings. Some of the most common formats are the following:</p>
<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr>
<th>Formatting Type</th>
<th>Description</th>
<th class="text-center">Supported by Sphynx</th>
<th class="text-center">Formal Specification</th>
</tr>
</thead>
<tbody>
<tr>
<td><a href="https://github.com/google/styleguide/blob/gh-pages/pyguide.md#38-comments-and-docstrings">Google docstrings</a></td>
<td>Google&rsquo;s recommended form of documentation</td>
<td class="text-center">Yes</td>
<td class="text-center">No</td>
</tr>
<tr>
<td><a href="http://docutils.sourceforge.net/rst.html">reStructuredText</a></td>
<td>Official Python documentation standard; Not beginner friendly but feature rich</td>
<td class="text-center">Yes</td>
<td class="text-center">Yes</td>
</tr>
<tr>
<td><a href="https://numpydoc.readthedocs.io/en/latest/format.html">NumPy/SciPy docstrings</a></td>
<td>NumPy&rsquo;s combination of reStructuredText and Google Docstrings</td>
<td class="text-center">Yes</td>
<td class="text-center">Yes</td>
</tr>
<tr>
<td><a href="http://epydoc.sourceforge.net/epytext.html">Epytext</a></td>
<td>A Python adaptation of Epydoc; Great for Java developers</td>
<td class="text-center">Not officially</td>
<td class="text-center">Yes</td>
</tr>
</tbody>
</table>
</div>
<p>The selection of the docstring format is up to you, but you should stick with the same format throughout your document/project. The following are examples of each type to give you an idea of how each documentation format looks.</p>
<section class="section4" id="google-docstrings-example"><h4>Google Docstrings Example<a class="headerlink" href="#google-docstrings-example" title="Permanent link"></a></h4>
<div class="highlight python"><pre><span></span><code><span class="sd">&quot;&quot;&quot;Gets and prints the spreadsheet&#39;s header columns</span>

<span class="sd">Args:</span>
<span class="sd">    file_loc (str): The file location of the spreadsheet</span>
<span class="sd">    print_cols (bool): A flag used to print the columns to the console</span>
<span class="sd">        (default is False)</span>

<span class="sd">Returns:</span>
<span class="sd">    list: a list of strings representing the header columns</span>
<span class="sd">&quot;&quot;&quot;</span>
</code></pre></div>
</section><section class="section4" id="restructuredtext-example"><h4>reStructuredText Example<a class="headerlink" href="#restructuredtext-example" title="Permanent link"></a></h4>
<div class="highlight python"><pre><span></span><code><span class="sd">&quot;&quot;&quot;Gets and prints the spreadsheet&#39;s header columns</span>

<span class="sd">:param file_loc: The file location of the spreadsheet</span>
<span class="sd">:type file_loc: str</span>
<span class="sd">:param print_cols: A flag used to print the columns to the console</span>
<span class="sd">    (default is False)</span>
<span class="sd">:type print_cols: bool</span>
<span class="sd">:returns: a list of strings representing the header columns</span>
<span class="sd">:rtype: list</span>
<span class="sd">&quot;&quot;&quot;</span>
</code></pre></div>
</section><section class="section4" id="numpyscipy-docstrings-example"><h4>NumPy/SciPy Docstrings Example<a class="headerlink" href="#numpyscipy-docstrings-example" title="Permanent link"></a></h4>
<div class="highlight python"><pre><span></span><code><span class="sd">&quot;&quot;&quot;Gets and prints the spreadsheet&#39;s header columns</span>

<span class="sd">Parameters</span>
<span class="sd">----------</span>
<span class="sd">file_loc : str</span>
<span class="sd">    The file location of the spreadsheet</span>
<span class="sd">print_cols : bool, optional</span>
<span class="sd">    A flag used to print the columns to the console (default is False)</span>

<span class="sd">Returns</span>
<span class="sd">-------</span>
<span class="sd">list</span>
<span class="sd">    a list of strings representing the header columns</span>
<span class="sd">&quot;&quot;&quot;</span>
</code></pre></div>
</section><section class="section4" id="epytext-example"><h4>Epytext Example<a class="headerlink" href="#epytext-example" title="Permanent link"></a></h4>
<div class="highlight python"><pre><span></span><code><span class="sd">&quot;&quot;&quot;Gets and prints the spreadsheet&#39;s header columns</span>

<span class="sd">@type file_loc: str</span>
<span class="sd">@param file_loc: The file location of the spreadsheet</span>
<span class="sd">@type print_cols: bool</span>
<span class="sd">@param print_cols: A flag used to print the columns to the console</span>
<span class="sd">    (default is False)</span>
<span class="sd">@rtype: list</span>
<span class="sd">@returns: a list of strings representing the header columns</span>
<span class="sd">&quot;&quot;&quot;</span>
</code></pre></div>
</section></section></section><section class="section2" id="documenting-your-python-projects"><h2>Documenting Your Python Projects<a class="headerlink" href="#documenting-your-python-projects" title="Permanent link"></a></h2>
<p>Python projects come in all sorts of shapes, sizes, and purposes. The way you document your project should suit your specific situation. Keep in mind who the users of your project are going to be and adapt to their needs. Depending on the project type, certain aspects of documentation are recommended. The general <a href="https://realpython.com/python-application-layouts/">layout</a> of the project and its documentation should be as follows:</p>
<div class="highlight"><pre><span></span><code>project_root/
│
├── project/  # Project source code
├── docs/
├── README
├── HOW_TO_CONTRIBUTE
├── CODE_OF_CONDUCT
├── examples.py
</code></pre></div>
<p>Projects can be generally subdivided into three major types: Private, Shared, and Public/Open Source.</p>
<section class="section3" id="private-projects"><h3>Private Projects<a class="headerlink" href="#private-projects" title="Permanent link"></a></h3>
<p>Private projects are projects intended for personal use only and generally aren&rsquo;t shared with other users or developers. Documentation can be pretty light on these types of projects. There are some recommended parts to add as needed:</p>
<ul>
<li><strong>Readme:</strong> A brief summary of the project and its purpose. Include any special requirements for installation or operating the project.</li>
<li><strong><code>examples.py</code>:</strong> A Python script file that gives simple examples of how to use the project.</li>
</ul>
<p>Remember, even though private projects are intended for you personally, you are also considered a user. Think about anything that may be confusing to you down the road and make sure to capture those in either comments, docstrings, or the readme.</p>
<div><div class="rounded border border-light" style="display:block;position:relative;"><div style="display:block;width:100%;padding-top:12.5%;"></div><div class="rpad rounded border" data-unit="8x1" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;"></div></div><a class="small text-muted" href="/account/join/" rel="nofollow"><i aria-hidden="true" class="fa fa-info-circle"> </i> Remove ads</a></div></section><section class="section3" id="shared-projects"><h3>Shared Projects<a class="headerlink" href="#shared-projects" title="Permanent link"></a></h3>
<p>Shared projects are projects in which you collaborate with a few other people in the development and/or use of the project. The &ldquo;customer&rdquo; or user of the project continues to be yourself and those limited few that use the project as well.</p>
<p>Documentation should be a little more rigorous than it needs to be for a private project, mainly to help onboard new members to the project or alert contributors/users of new changes to the project. Some of the recommended parts to add to the project are the following:</p>
<ul>
<li><strong>Readme:</strong> A brief summary of the project and its purpose. Include any special requirements for installing or operating the project. Additionally, add any major changes since the previous version.</li>
<li><strong><code>examples.py</code>:</strong> A Python script file that gives simple examples of how to use the projects.</li>
<li><strong>How to Contribute:</strong> This should include how new contributors to the project can start contributing.</li>
</ul>
</section><section class="section3" id="public-and-open-source-projects"><h3>Public and Open Source Projects<a class="headerlink" href="#public-and-open-source-projects" title="Permanent link"></a></h3>
<p>Public and Open Source projects are projects that are intended to be shared with a large group of users and can involve large development teams. These projects should place as high of a priority on project documentation as the actual development of the project itself. Some of the recommended parts to add to the project are the following:</p>
<ul>
<li>
<p><strong>Readme:</strong> A brief summary of the project and its purpose. Include any special requirements for installing or operating the projects. Additionally, add any major changes since the previous version. Finally, add links to further documentation, bug reporting, and any other important information for the project. Dan Bader has put together <a href="https://dbader.org/blog/write-a-great-readme-for-your-github-project">a great tutorial</a> on what all should be included in your readme.</p>
</li>
<li>
<p><strong>How to Contribute:</strong> This should include how new contributors to the project can help. This includes developing new features, fixing known issues, adding documentation, adding new tests, or reporting issues.</p>
</li>
<li>
<p><strong>Code of Conduct:</strong> Defines how other contributors should treat each other when developing or using your software. This also states what will happen if this code is broken. If you&rsquo;re using Github, a Code of Conduct <a href="https://help.github.com/articles/adding-a-code-of-conduct-to-your-project/">template</a> can be generated with recommended wording. For Open Source projects especially, consider adding this.</p>
</li>
<li>
<p><strong>License:</strong> A plaintext file that describes the license your project is using. For Open Source projects especially, consider adding this.</p>
</li>
<li>
<p><strong>docs:</strong> A folder that contains further documentation. The next section describes more fully what should be included and how to organize the contents of this folder.</p>
</li>
</ul>
<section class="section4" id="the-four-main-sections-of-the-docs-folder"><h4>The Four Main Sections of the <code>docs</code> Folder<a class="headerlink" href="#the-four-main-sections-of-the-docs-folder" title="Permanent link"></a></h4>
<p>Daniele Procida gave a wonderful <a href="https://www.youtube.com/watch?v=azf6yzuJt54">PyCon 2017 talk</a> and subsequent <a href="https://www.divio.com/en/blog/documentation/">blog post</a> about documenting Python projects. He mentions that all projects should have the following four major sections to help you focus your work:</p>
<ul>
<li><strong>Tutorials</strong>: Lessons that take the reader by the hand through a series of steps to complete a project (or meaningful exercise). Geared towards the user&rsquo;s learning.</li>
<li><strong>How-To Guides</strong>: Guides that take the reader through the steps required to solve a common problem (problem-oriented recipes).</li>
<li><strong>References</strong>: Explanations that clarify and illuminate a particular topic. Geared towards understanding.</li>
<li><strong>Explanations</strong>: Technical descriptions of the machinery and how to operate it (key classes, functions, APIs, and so forth). Think Encyclopedia article.</li>
</ul>
<p>The following table shows how all of these sections relates to each other as well as their overall purpose:</p>
<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr>
<th class="text-right"></th>
<th class="text-center">Most Useful When We&rsquo;re Studying</th>
<th class="text-center">Most Useful When We&rsquo;re Coding</th>
</tr>
</thead>
<tbody>
<tr>
<td class="text-right"><strong>Practical Step</strong></td>
<td class="text-center"><em>Tutorials</em></td>
<td class="text-center"><em>How-To Guides</em></td>
</tr>
<tr>
<td class="text-right"><strong>Theoretical Knowledge</strong></td>
<td class="text-center"><em>Explanation</em></td>
<td class="text-center"><em>Reference</em></td>
</tr>
</tbody>
</table>
</div>
<p>In the end, you want to make sure that your users have access to the answers to any questions they may have. By organizing your project in this manner, you&rsquo;ll be able to answer those questions easily and in a format they&rsquo;ll be able to navigate quickly.</p>
</section></section><section class="section3" id="documentation-tools-and-resources"><h3>Documentation Tools and Resources<a class="headerlink" href="#documentation-tools-and-resources" title="Permanent link"></a></h3>
<p>Documenting your code, especially large projects, can be daunting. Thankfully there are some tools out and references to get you started:</p>
<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr>
<th>Tool</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><a href="http://www.sphinx-doc.org/en/stable/">Sphinx</a></td>
<td>A collection of tools to auto-generate documentation in multiple formats</td>
</tr>
<tr>
<td><a href="http://epydoc.sourceforge.net/">Epydoc</a></td>
<td>A tool for generating API documentation for Python modules based on their docstrings</td>
</tr>
<tr>
<td><a href="https://readthedocs.org/">Read The Docs</a></td>
<td>Automatic building, versioning, and hosting of your docs for you</td>
</tr>
<tr>
<td><a href="https://www.doxygen.nl/manual/docblocks.html">Doxygen</a></td>
<td>A tool for generating documentation that supports Python as well as multiple other languages</td>
</tr>
<tr>
<td><a href="https://www.mkdocs.org/">MkDocs</a></td>
<td>A static site generator to help build project documentation using the Markdown language</td>
</tr>
<tr>
<td><a href="https://pycco-docs.github.io/pycco/">pycco</a></td>
<td>A &ldquo;quick and dirty&rdquo; documentation generator that displays code and documentation side by side. Check out <a href="https://realpython.com/generating-code-documentation-with-pycco/">our tutorial on how to use it for more info</a>.</td>
</tr>
</tbody>
</table>
</div>
<p>Along with these tools, there are some additional tutorials, videos, and articles that can be useful when you are documenting your project:</p>
<ol>
<li><a href="https://www.youtube.com/watch?v=0ROZRNZkPS8">Carol Willing - Practical Sphinx - PyCon 2018</a></li>
<li><a href="https://www.youtube.com/watch?v=bQSR1UpUdFQ">Daniele Procida - Documentation-driven development - Lessons from the Django Project - PyCon 2016</a></li>
<li><a href="https://www.youtube.com/watch?v=hM4I58TA72g">Eric Holscher - Documenting your project with Sphinx &amp; Read the Docs - PyCon 2016</a></li>
<li><a href="https://youtu.be/SUt3wT43AeM?t=6299">Titus Brown, Luiz Irber - Creating, building, testing, and documenting a Python project: a hands-on HOWTO - PyCon 2016</a></li>
<li><a href="http://docutils.sourceforge.net/rst.html">reStructuredText Official Documentation</a></li>
<li><a href="http://www.sphinx-doc.org/en/master/usage/restructuredtext/basics.html">Sphinx&rsquo;s reStructuredText Primer</a></li>
</ol>
<p>Sometimes, the best way to learn is to mimic others. Here are some great examples of projects that use documentation well:</p>
<ul>
<li><strong>Django:</strong> <a href="https://docs.djangoproject.com/en/2.0/">Docs</a> (<a href="https://github.com/django/django/tree/master/docs">Source</a>)</li>
<li><strong>Requests:</strong> <a href="https://requests.readthedocs.io/en/master/">Docs</a> (<a href="https://github.com/requests/requests/tree/master/docs">Source</a>)</li>
<li><strong>Click:</strong> <a href="http://click.pocoo.org/dev/">Docs</a> (<a href="https://github.com/pallets/click/tree/master/docs">Source</a>)</li>
<li><strong>Pandas:</strong> <a href="http://pandas.pydata.org/pandas-docs/stable/">Docs</a> (<a href="https://github.com/pandas-dev/pandas/tree/master/doc">Source</a>)</li>
</ul>
<div><div class="rounded border border-light" style="display:block;position:relative;"><div style="display:block;width:100%;padding-top:12.5%;"></div><div class="rpad rounded border" data-unit="8x1" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;"></div></div><a class="small text-muted" href="/account/join/" rel="nofollow"><i aria-hidden="true" class="fa fa-info-circle"> </i> Remove ads</a></div></section></section><section class="section2" id="where-do-i-start"><h2>Where Do I Start?<a class="headerlink" href="#where-do-i-start" title="Permanent link"></a></h2>
<p>The documentation of projects have a simple progression:</p>
<ol>
<li>No Documentation</li>
<li>Some Documentation</li>
<li>Complete Documentation</li>
<li>Good Documentation</li>
<li>Great Documentation</li>
</ol>
<p>If you&rsquo;re at a loss about where to go next with your documentation, look at where your project is now in relation to the progression above. Do you have any documentation? If not, then start there. If you have some documentation but are missing some of the key project files, get started by adding those.</p>
<p>In the end, don&rsquo;t get discouraged or overwhelmed by the amount of work required for documenting code. Once you get started documenting your code, it becomes easier to keep going. Feel free to comment if you have questions or reach out to the Real Python Team on social media, and we&rsquo;ll help.</p>
</section>
<div class="text-center my-3">
<div class="jsCompletionStatusWidget btn-group mb-0">
<button title="Click to mark as completed" class="jsBtnCompletion btn btn-secondary border-right " style="border-top-right-radius: 0; border-bottom-right-radius: 0;" disabled>Mark as Completed</button>
<button title="Add bookmark" class="jsBtnBookmark btn btn-secondary border-left" disabled><i class="fa fa-fw fa-bookmark-o"></i></button>
</div>
</div>
<div class="border rounded p-3 card mb-2">
<p class="mb-0"><span class="badge badge-pill badge-success"><i class="fa fa-play-circle" aria-hidden="true"></i> Watch Now</span> This tutorial has a related video course created by the Real Python team. Watch it together with the written tutorial to deepen your understanding: <a class="stretched-link text-success" href="/courses/documenting-python-code/"><strong>Documenting Python Code: A Complete Guide</strong></a></p>
</div>
</div>
<div class="card mt-4 mb-4 bg-secondary">
<p class="card-header h3 text-center bg-light">🐍 Python Tricks 💌</p>
<div class="card-body">
<div class="container">
<div class="row">
<div class="col-xs-12 col-sm-7">
<p>Get a short &amp; sweet <strong>Python Trick</strong> delivered to your inbox every couple of days. No spam ever. Unsubscribe any time. Curated by the Real Python team.</p>
</div>
<div class="col-xs-12 col-sm-5">
<img class="img-fluid rounded mb-3" src="https://cdn.realpython.com/static/pytrick-dict-merge.4201a0125a5e.png" width="738" height="490" alt="Python Tricks Dictionary Merge">
</div>
</div>
<div class="row mb-3">
<form class="col-12" action="/optins/process/" method="post">
<input type="hidden" name="csrfmiddlewaretoken" value="YccFHlD3adTtHxhP46Dv4gXr8O9i5iUr90a7apUlAyiYcwAGLiyp86xhMSkKl544">
<input type="hidden" name="slug" value="static-python-tricks-footer">
<div class="form-group">
<input name="email" type="email" class="form-control form-control-lg" placeholder="Email Address" required>
</div>
<button name="submit" type="submit" class="btn btn-primary btn-lg btn-block">Send Me Python Tricks »</button>
</form>
</div>
</div>
</div>
</div>
<div class="card mt-3" id="author">
<p class="card-header h3">About <strong>James Mertz</strong></p>
<div class="card-body">
<div class="container p-0">
<div class="row">
<div class="col-12 col-md-3 align-self-center">
<a href="/team/jmertz/"><img loading="lazy" src="https://robocrop.realpython.net/?url=https%3A//files.realpython.com/media/34794694_10156797037667697_8713056503919017984_n.0b174d713b06.jpg&amp;w=959&amp;h=959&amp;mode=crop&amp;sig=1e3cfd6ee89d3b66bd3a3427dedb177036dfec88" srcset="https://robocrop.realpython.net/?url=https%3A//files.realpython.com/media/34794694_10156797037667697_8713056503919017984_n.0b174d713b06.jpg&amp;w=239&amp;h=239&amp;mode=crop&amp;sig=95f7db9bbd9bea8ebf5543df6a4c8a75acd66566 239w, https://robocrop.realpython.net/?url=https%3A//files.realpython.com/media/34794694_10156797037667697_8713056503919017984_n.0b174d713b06.jpg&amp;w=479&amp;h=479&amp;mode=crop&amp;sig=251d5a771dfbe3f367c77c8ab5550a8dbfe55eff 479w, https://robocrop.realpython.net/?url=https%3A//files.realpython.com/media/34794694_10156797037667697_8713056503919017984_n.0b174d713b06.jpg&amp;w=959&amp;h=959&amp;mode=crop&amp;sig=1e3cfd6ee89d3b66bd3a3427dedb177036dfec88 959w" sizes="25vw" width="959" height="959" class="d-block d-md-none rounded-circle img-fluid w-33 mb-0 mx-auto" alt="James Mertz"></a>
<a href="/team/jmertz/"><img loading="lazy" src="https://robocrop.realpython.net/?url=https%3A//files.realpython.com/media/34794694_10156797037667697_8713056503919017984_n.0b174d713b06.jpg&amp;w=959&amp;h=959&amp;mode=crop&amp;sig=1e3cfd6ee89d3b66bd3a3427dedb177036dfec88" srcset="https://robocrop.realpython.net/?url=https%3A//files.realpython.com/media/34794694_10156797037667697_8713056503919017984_n.0b174d713b06.jpg&amp;w=239&amp;h=239&amp;mode=crop&amp;sig=95f7db9bbd9bea8ebf5543df6a4c8a75acd66566 239w, https://robocrop.realpython.net/?url=https%3A//files.realpython.com/media/34794694_10156797037667697_8713056503919017984_n.0b174d713b06.jpg&amp;w=479&amp;h=479&amp;mode=crop&amp;sig=251d5a771dfbe3f367c77c8ab5550a8dbfe55eff 479w, https://robocrop.realpython.net/?url=https%3A//files.realpython.com/media/34794694_10156797037667697_8713056503919017984_n.0b174d713b06.jpg&amp;w=959&amp;h=959&amp;mode=crop&amp;sig=1e3cfd6ee89d3b66bd3a3427dedb177036dfec88 959w" sizes="25vw" width="959" height="959" class="d-none d-md-block rounded-circle img-fluid w-100 mb-0" alt="James Mertz"></a>
</div>
<div class="col 
649b
mt-3">
<p>James is a passionate Python developer at NASA&#x27;s Jet Propulsion Lab who also writes on the side for Real Python.</p>
<a href="/team/jmertz/" class="card-link">» More about James</a>
</div>
</div>
</div>
</div>
<hr class="my-0">
<div class="card-body pb-0">
<div class="container">
<div class="row">
<p><em>Each tutorial at Real Python is created by a team of developers so that it meets our high quality standards. The team members who worked on this tutorial are:</em></p>
</div>
<div class="row align-items-center w-100 mx-auto">
<div class="col-4 col-sm-2 align-self-center">
<a href="/team/asantos/"><img loading="lazy" src="https://robocrop.realpython.net/?url=https%3A//files.realpython.com/media/PP.9b8b026f75b8.jpg&amp;w=959&amp;h=959&amp;mode=crop&amp;sig=70bedc2eab90a227eb9a657c415689c3eb1eca4f" srcset="https://robocrop.realpython.net/?url=https%3A//files.realpython.com/media/PP.9b8b026f75b8.jpg&amp;w=239&amp;h=239&amp;mode=crop&amp;sig=11667a6dd5c29e4c9363f18be59360551af5eddc 239w, https://robocrop.realpython.net/?url=https%3A//files.realpython.com/media/PP.9b8b026f75b8.jpg&amp;w=479&amp;h=479&amp;mode=crop&amp;sig=1541e1ec541357813def826d8507c0565164b701 479w, https://robocrop.realpython.net/?url=https%3A//files.realpython.com/media/PP.9b8b026f75b8.jpg&amp;w=959&amp;h=959&amp;mode=crop&amp;sig=70bedc2eab90a227eb9a657c415689c3eb1eca4f 959w" sizes="10vw" width="959" height="959" class="rounded-circle img-fluid w-100" alt="Aldren Santos"></a>
</div>
<div class="col pl-0 d-none d-sm-block">
<a href="/team/asantos/" class="card-link small"><p>Aldren</p></a>
</div>
<div class="col-4 col-sm-2 align-self-center">
<a href="/team/dbader/"><img loading="lazy" src="https://robocrop.realpython.net/?url=https%3A//files.realpython.com/media/daniel-square.d58bf4388750.jpg&amp;w=1000&amp;h=1000&amp;mode=crop&amp;sig=304f5f568993310d5e87b2ca3c504260c018effa" srcset="https://robocrop.realpython.net/?url=https%3A//files.realpython.com/media/daniel-square.d58bf4388750.jpg&amp;w=250&amp;h=250&amp;mode=crop&amp;sig=981634b4528584f2e9c7ee663477173599e1781a 250w, https://robocrop.realpython.net/?url=https%3A//files.realpython.com/media/daniel-square.d58bf4388750.jpg&amp;w=500&amp;h=500&amp;mode=crop&amp;sig=841025b97d25f05c1b90802032e477020462fe01 500w, https://robocrop.realpython.net/?url=https%3A//files.realpython.com/media/daniel-square.d58bf4388750.jpg&amp;w=1000&amp;h=1000&amp;mode=crop&amp;sig=304f5f568993310d5e87b2ca3c504260c018effa 1000w" sizes="10vw" width="959" height="959" class="rounded-circle img-fluid w-100" alt="Dan Bader"></a>
</div>
<div class="col pl-0 d-none d-sm-block">
<a href="/team/dbader/" class="card-link small"><p>Dan</p></a>
</div>
<div class="col-4 col-sm-2 align-self-center">
<a href="/team/jjablonski/"><img loading="lazy" src="https://robocrop.realpython.net/?url=https%3A//files.realpython.com/media/jjablonksi-avatar.e37c4f83308e.jpg&amp;w=800&amp;h=800&amp;mode=crop&amp;sig=c363b704eeccb35f2247db13baff3d4383459858" srcset="https://robocrop.realpython.net/?url=https%3A//files.realpython.com/media/jjablonksi-avatar.e37c4f83308e.jpg&amp;w=200&amp;h=200&amp;mode=crop&amp;sig=706b16de3cb88a8f353f4a98d7c7bc7234229bd0 200w, https://robocrop.realpython.net/?url=https%3A//files.realpython.com/media/jjablonksi-avatar.e37c4f83308e.jpg&amp;w=400&amp;h=400&amp;mode=crop&amp;sig=6d7aa672ca3f1ac5f7cd62ed1641b60f98d04d8b 400w, https://robocrop.realpython.net/?url=https%3A//files.realpython.com/media/jjablonksi-avatar.e37c4f83308e.jpg&amp;w=800&amp;h=800&amp;mode=crop&amp;sig=c363b704eeccb35f2247db13baff3d4383459858 800w" sizes="10vw" width="959" height="959" class="rounded-circle img-fluid w-100" alt="Joanna Jablonski"></a>
</div>
<div class="col pl-0 d-none d-sm-block">
<a href="/team/jjablonski/" class="card-link small"><p>Joanna</p></a>
</div>
</div>
</div>
</div>
</div>
<div class="bg-light rounded py-4 my-4 shadow shadow-sm mx-n2">
<div class="col-12 text-center d-block d-md-none">
<p class="h2 mb-3">Master <u><span class="marker-highlight">Real-World Python Skills</mark></u> With Unlimited Access to Real&nbsp;Python</p>
<p class="mb-1"><img class="w-75" src="https://cdn.realpython.com/static/videos/lesson-locked.f5105cfd26db.svg" width="510" height="260"></p>
<p class="mx-auto w-75 mb-3 small"><strong>Join us and get access to hundreds of tutorials, hands-on video courses, and a community of expert&nbsp;Pythonistas:</strong></p>
<p class="mb-0"><a href="/account/join/?utm_source=rp_article_footer&utm_content=documenting-python-code" class="btn btn-primary btn-sm px-4 mb-0">Level Up Your Python Skills »</a>
</div>
<div class="col-12 text-center d-none d-md-block">
<p class="h2 mb-2">Master <u><span class="marker-highlight">Real-World Python Skills</span></u><br>With Unlimited Access to Real&nbsp;Python</p>
<p class="mb-2"><img class="w-50 mb-2" src="https://cdn.realpython.com/static/videos/lesson-locked.f5105cfd26db.svg" width="510" height="260"></p>
<p class="mx-auto w-50 mb-3"><strong>Join us and get access to hundreds of tutorials, hands-on video courses, and a community of expert Pythonistas:</strong></p>
<p><a href="/account/join/?utm_source=rp_article_footer&utm_content=documenting-python-code" class="btn btn-primary btn-lg px-4">Level Up Your Python Skills »</a>
</div>
</div>
<div class="card mt-4" id="reader-comments">
<p class="card-header h3">What Do You Think?</p>
<div class="text-center mt-3 mb-0 p-0">
<span>
<a target="_blank" rel="nofollow" href="https://twitter.com/intent/tweet/?text=Check out this %23Python tutorial: Documenting%20Python%20Code%3A%20A%20Complete%20Guide by @realpython&url=https%3A//realpython.com/documenting-python-code/" class="mr-1 badge badge-twitter text-light mb-1"><i class="mr-1 fa fa-twitter text-light"></i>Tweet</a>
<a target="_blank" rel="nofollow" href="https://facebook.com/sharer/sharer.php?u=https%3A//realpython.com/documenting-python-code/" class="mr-1 badge badge-facebook text-light mb-1"><i class="mr-1 fa fa-facebook text-light"></i>Share</a>
<a target="_blank" rel="nofollow" href="mailto:?subject=Python article for you&body=Check out this Python tutorial:%0A%0ADocumenting%20Python%20Code%3A%20A%20Complete%20Guide%0A%0Ahttps%3A//realpython.com/documenting-python-code/" class="badge badge-red text-light mb-1"><i class="mr-1 fa fa-envelope text-light"></i>Email</a>
</span>
</div>
<div class="card-body">
<div class="alert alert-dark">
<p class="mb-0"><strong>Real Python Comment Policy:</strong> The most useful comments are those written with the goal of learning from or helping out other readers—after reading the whole article and all the earlier comments. Complaints and insults generally won’t make the cut here.</p>
</div>
<p>What’s your #1 takeaway or favorite thing you learned? How are you going to put your newfound skills to use? Leave a comment below and let us know.</p>
<div class="mb-4" id="disqus_thread">
</div>
</div>
</div>
<div class="card mt-4 mb-4">
<p class="card-header h3">Keep Learning</p>
<div class="card-body">
<p class="mb-0">Related Tutorial Categories:
<a href="/tutorials/best-practices/" class="badge badge-light text-muted">best-practices</a>
<a href="/tutorials/intermediate/" class="badge badge-light text-muted">intermediate</a>
<a href="/tutorials/python/" class="badge badge-light text-muted">python</a>
</p>
<p class="mt-3 mb-0">Recommended Video Course: <a class="text-success" href="/courses/documenting-python-code/">Documenting Python Code: A Complete Guide</a></p>
</div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="rprw">
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header border-0 mt-3">
<div class="col-12 modal-title text-center">
<h2 class="my-0 mx-5">Keep reading Real&nbsp;Python by creating a free account or signing&nbsp;in:</h2>
</div>
</div>
<div class="modal-body bg-light">
<div class="col-12 text-center">
<p class="mb-2 mt-3"><a href="/account/signup/?intent=continue_reading&utm_source=rp&utm_medium=web&utm_campaign=rwn&utm_content=v1&next=%2Fdocumenting-python-code%2F"><img class="w-50 mb-2" src="https://cdn.realpython.com/static/videos/lesson-locked.f5105cfd26db.svg" width="510" height="260" alt="Keep reading"></a></p>
<p><a href="/account/signup/?intent=continue_reading&utm_source=rp&utm_medium=web&utm_campaign=rwn&utm_content=v1&next=%2Fdocumenting-python-code%2F" class="btn btn-primary btn-lg px-5"></i>Continue »</a></a>
</div>
</div>
<div class="modal-footer border-0">
<p class="text-center text-muted mt-2 mb-1">Already have an account? <a href="/account/login/?next=/documenting-python-code/">Sign-In</a></p>
</div>
</div>
</div>
</div>
<script src="https://cdn.realpython.com/static/frontend/reader/rw.38bf29157dfe.js" async></script>
</div>
<aside class="col-md-7 col-lg-4">
<div class="card mb-3 bg-secondary">
<form class="card-body" action="/optins/process/" method="post">
<div class="form-group">
<p class="h5 text-muted text-center">— FREE Email Series —</p>
<p class="h3 text-center">🐍 Python Tricks 💌</p>
<p><img class="img-fluid rounded" src="https://cdn.realpython.com/static/pytrick-dict-merge.4201a0125a5e.png" width="738" height="490" alt="Python Tricks Dictionary Merge"></p>
</div>
<div class="form-group">
<input type="hidden" name="csrfmiddlewaretoken" value="YccFHlD3adTtHxhP46Dv4gXr8O9i5iUr90a7apUlAyiYcwAGLiyp86xhMSkKl544">
<input type="hidden" name="slug" value="static-python-tricks-sidebar">
<input type="email" class="form-control form-control-md" name="email" placeholder="Email&hellip;" required>
</div>
<button type="submit" name="submit" class="btn btn-primary btn-md btn-block">Get Python Tricks »</button>
<p class="mb-0 mt-2 text-muted text-center">🔒 No spam. Unsubscribe any time.</p>
</form>
</div>
<div class="sidebar-module sidebar-module-inset border">
<p class="h4"><a class="link-unstyled" href="/tutorials/all/">All Tutorial Topics</a></p>
<a href="/tutorials/advanced/" class="badge badge-light text-muted">advanced</a>
<a href="/tutorials/api/" class="badge badge-light text-muted">api</a>
<a href="/tutorials/basics/" class="badge badge-light text-muted">basics</a>
<a href="/tutorials/best-practices/" class="badge badge-light text-muted">best-practices</a>
<a href="/tutorials/community/" class="badge badge-light text-muted">community</a>
<a href="/tutorials/databases/" class="badge badge-light text-muted">databases</a>
<a href="/tutorials/data-science/" class="badge badge-light text-muted">data-science</a>
<a href="/tutorials/devops/" class="badge badge-light text-muted">devops</a>
<a href="/tutorials/django/" class="badge badge-light text-muted">django</a>
<a href="/tutorials/docker/" class="badge badge-light text-muted">docker</a>
<a href="/tutorials/flask/" class="badge badge-light text-muted">flask</a>

<a href="/tutorials/front-end/" class="badge badge-light text-muted">front-end</a>
<a href="/tutorials/gamedev/" class="badge badge-light text-muted">gamedev</a>
<a href="/tutorials/gui/" class="badge badge-light text-muted">gui</a>
<a href="/tutorials/intermediate/" class="badge badge-light text-muted">intermediate</a>
<a href="/tutorials/machine-learning/" class="badge badge-light text-muted">machine-learning</a>
<a href="/tutorials/projects/" class="badge badge-light text-muted">projects</a>
<a href="/tutorials/python/" class="badge badge-light text-muted">python</a>
<a href="/tutorials/testing/" class="badge badge-light text-muted">testing</a>
<a href="/tutorials/tools/" class="badge badge-light text-muted">tools</a>
<a href="/tutorials/web-dev/" class="badge badge-light text-muted">web-dev</a>
<a href="/tutorials/web-scraping/" class="badge badge-light text-muted">web-scraping</a>
</div>
<div class="sidebar-module sidebar-module-inset p-0" style="overflow:hidden;">
<div style="display:block;position:relative;">
<div style="display:block;width:100%;padding-top:100%;"></div>
<div class="rpad" data-unit="1x1" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;"></div>
</div>
</div>
<div class="sidebar-sticky ">
<div class="bg-light sidebar-module sidebar-module-inset" id="sidebar-toc">
<p class="h4 text-muted"><a class="link-unstyled" href="#toc">Table of Contents</a></p>
<div class="toc">
<ul>
<li><a href="#why-documenting-your-code-is-so-important">Why Documenting Your Code Is So Important</a></li>
<li><a href="#commenting-vs-documenting-code">Commenting vs Documenting Code</a><ul>
<li><a href="#basics-of-commenting-code">Basics of Commenting Code</a></li>
<li><a href="#commenting-code-via-type-hinting-python-35">Commenting Code via Type Hinting (Python 3.5+)</a></li>
</ul>
</li>
<li><a href="#documenting-your-python-code-base-using-docstrings">Documenting Your Python Code Base Using Docstrings</a><ul>
<li><a href="#docstrings-background">Docstrings Background</a></li>
<li><a href="#docstring-types">Docstring Types</a></li>
<li><a href="#docstring-formats">Docstring Formats</a></li>
</ul>
</li>
<li><a href="#documenting-your-python-projects">Documenting Your Python Projects</a><ul>
<li><a href="#private-projects">Private Projects</a></li>
<li><a href="#shared-projects">Shared Projects</a></li>
<li><a href="#public-and-open-source-projects">Public and Open Source Projects</a></li>
<li><a href="#documentation-tools-and-resources">Documentation Tools and Resources</a></li>
</ul>
</li>
<li><a href="#where-do-i-start">Where Do I Start?</a></li>
</ul>
</div>
</div>
<div class="sidebar-module sidebar-module-inset text-center my-3 py-0">
<div class="jsCompletionStatusWidget btn-group mb-0">
<button title="Click to mark as completed" class="jsBtnCompletion btn btn-secondary border-right " style="border-top-right-radius: 0; border-bottom-right-radius: 0;" disabled>Mark as Completed</button>
<button title="Add bookmark" class="jsBtnBookmark btn btn-secondary border-left" disabled><i class="fa fa-fw fa-bookmark-o"></i></button>
</div>
</div>
<div class="sidebar-module sidebar-module-inset text-center my-3 py-0">
<span>
<a target="_blank" rel="nofollow" href="https://twitter.com/intent/tweet/?text=Check out this %23Python tutorial: Documenting%20Python%20Code%3A%20A%20Complete%20Guide by @realpython&url=https%3A//realpython.com/documenting-python-code/" class="mr-1 badge badge-twitter text-light mb-1"><i class="mr-1 fa fa-twitter text-light"></i>Tweet</a>
<a target="_blank" rel="nofollow" href="https://facebook.com/sharer/sharer.php?u=https%3A//realpython.com/documenting-python-code/" class="mr-1 badge badge-facebook text-light mb-1"><i class="mr-1 fa fa-facebook text-light"></i>Share</a>
<a target="_blank" rel="nofollow" href="mailto:?subject=Python article for you&body=Check out this Python tutorial:%0A%0ADocumenting%20Python%20Code%3A%20A%20Complete%20Guide%0A%0Ahttps%3A//realpython.com/documenting-python-code/" class="badge badge-red text-light mb-1"><i class="mr-1 fa fa-envelope text-light"></i>Email</a>
</span>
</div>
<div class="sidebar-module sidebar-module-inset border card">
<p><span class="badge badge-pill badge-success"><i class="fa fa-play-circle mr-1" aria-hidden="true"></i> Recommended Video Course</span><br><a class="stretched-link text-success" href="/courses/documenting-python-code/">Documenting Python Code: A Complete Guide</a></p>
</div>
<div class="sidebar-module sidebar-module-inset p-0" style="overflow:hidden;">
<div style="display:block;position:relative;">
<div style="display:block;width:100%;padding-top:25%;"></div>
<div class="rpad" data-unit="4x1" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;"></div>
</div>
</div>
</div>
</aside>
</div>
</div>
<footer class="footer">
<div class="container">
<div class="w-75 mx-auto mt-4 mb-0">
<div style="display:block;position:relative;">
<div style="display:block;width:100%;padding-top:12.5%;"></div>
<div class="rpad rounded border" data-unit="8x1" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;"></div>
</div>
<a class="small text-muted" href="/account/join/" rel="nofollow"> <i class="fa fa-info-circle" aria-hidden="true"> </i> Remove ads</a>
</div>
<p class="text-center text-muted w-75 mx-auto">© 2012–2022 Real Python&nbsp;⋅ <a href="/newsletter/">Newsletter</a>&nbsp;⋅ <a href="/podcasts/rpp/">Podcast</a>&nbsp;⋅ <a href="https://www.youtube.com/realpython">YouTube</a>&nbsp;⋅ <a href="https://twitter.com/realpython">Twitter</a>&nbsp;⋅ <a href="https://facebook.com/LearnRealPython">Facebook</a>&nbsp;⋅ <a href="https://www.instagram.com/realpython/">Instagram</a>&nbsp;⋅ <a href="/">Python&nbsp;Tutorials</a>&nbsp;⋅ <a href="/search">Search</a>&nbsp;⋅ <a href="/privacy-policy/">Privacy Policy</a>&nbsp;⋅ <a href="/energy-policy/" class="text-success active">Energy Policy</a>&nbsp;⋅ <a href="/sponsorships/">Advertise</a>&nbsp;⋅ <a href="/contact/">Contact</a><br>❤️ Happy Pythoning!</p>
</div>
</footer>
<script>
      (function(document, history, location) {
        var HISTORY_SUPPORT = !!(history && history.pushState);

        var anchorScrolls = {
          ANCHOR_REGEX: /^#[^ ]+$/,
          OFFSET_HEIGHT_PX: 120,

          /**
           * Establish events, and fix initial scroll position if a hash is provided.
           */
          init: function() {
            this.scrollToCurrent();
            window.addEventListener('hashchange', this.scrollToCurrent.bind(this));
            document.body.addEventListener('click', this.delegateAnchors.bind(this));
          },

          /**
           * Return the offset amount to deduct from the normal scroll position.
           * Modify as appropriate to allow for dynamic calculations
           */
          getFixedOffset: function() {
            return this.OFFSET_HEIGHT_PX;
          },

          /**
           * If the provided href is an anchor which resolves to an element on the
           * page, scroll to it.
           * @param  {String} href
           * @return {Boolean} - Was the href an anchor.
           */
          scrollIfAnchor: function(href, pushToHistory) {
            var match, rect, anchorOffset;

            if(!this.ANCHOR_REGEX.test(href)) {
              return false;
            }

            match = document.getElementById(href.slice(1));

            if(match) {
              rect = match.getBoundingClientRect();
              anchorOffset = window.pageYOffset + rect.top - this.getFixedOffset();
              window.scrollTo(window.pageXOffset, anchorOffset);

              // Add the state to history as-per normal anchor links
              if(HISTORY_SUPPORT && pushToHistory) {
                history.pushState({}, document.title, location.pathname + href);
              }
            }

            return !!match;
          },

          /**
           * Attempt to scroll to the current location's hash.
           */
          scrollToCurrent: function() {
            this.scrollIfAnchor(window.location.hash);
          },

          /**
           * If the click event's target was an anchor, fix the scroll position.
           */
          delegateAnchors: function(e) {
            var elem = e.target;

            // 
            if (elem.dataset.toggle === "tab") {
              return;
            }

            if(
              elem.nodeName === 'A' &&
              this.scrollIfAnchor(elem.getAttribute('href'), true)
            ) {
              e.preventDefault();
            }
          }
        };

        window.addEventListener(
          'DOMContentLoaded', anchorScrolls.init.bind(anchorScrolls)
        );
      })(window.document, window.history, window.location);
    </script>
<script>
      (function() {
        var isAndroid = navigator.userAgent.toLowerCase().indexOf("android") > -1;
        if (!isAndroid) {
          return;
        }

        var styles = `
        @font-face {
          font-family: 'DejaVu Sans Mono';
          font-weight: normal;
          font-style: normal;
          font-display: swap;
          src: url('https://cdn.realpython.com/static/mfonts/dejavu-sans-mono.33f00225f915.woff2') format('woff2'),
               url('https://cdn.realpython.com/static/mfonts/dejavu-sans-mono.0da77d3739f3.woff') format('woff'),
               url('https://cdn.realpython.com/static/mfonts/dejavu-sans-mono.c2356fc49835.ttf') format('truetype');
        }
        code, kbd, pre, samp {
          font-family: 'DejaVu Sans Mono', monospace;
        }
        `

        var styleSheet = document.createElement("style")
        styleSheet.type = "text/css"
        styleSheet.innerText = styles
        document.head.appendChild(styleSheet)
      })();
    </script>
<script src="https://cdn.realpython.com/static/jquery.min.8fb8fee4fcc3.js"></script>
<script src="https://cdn.realpython.com/static/popper.min.1022eaf388cc.js"></script>
<script src="https://cdn.realpython.com/static/bootstrap.min.f0c2bcf5ef0c.js"></script>
<script>
    (function() {
      document.querySelectorAll(".js-search-form-submit").forEach(function(el) {
        el.addEventListener("click", function(e) {
          e.preventDefault();
          e.currentTarget.parentElement.submit();
        })
      });
    })();
    </script>
<script src="https://cdn.realpython.com/static/frontend/reader/repl-toggle.925bef973b9c.js" async></script>
<script src="https://cdn.realpython.com/static/frontend/reader/lightbox.49cdac39212e.js" async></script>
<script src="https://cdn.realpython.com/static/frontend/reader/platforms-ui.b11202dc6079.js" async></script>
<script>window.rp_prop_id = '58946116052';</script>
<script src="https://srv.realpython.net/tag.js" async></script>
<script src="https://cdn.realpython.com/static/frontend/reader/toc-refresh.76a102c7d921.js" async></script>
<script id="js-context" type="application/json">{"is_completed": false, "is_bookmarked": false, "api_article_bookmark_url": "/api/v1/articles/documenting-python-code/bookmark/", "api_article_completion_status_url": "/api/v1/articles/documenting-python-code/completion_status/"}</script>
<script src="https://cdn.realpython.com/static/frontend/reader/completion-status.352d07abd84a.js" async></script>
<script id="dsq-count-scr" src="https://realpython.disqus.com/count.js" async></script>
<script>
      var disqus_config = function () {
        this.page.url = 'https://realpython.com/documenting-python-code/';
        this.page.identifier = 'https://realpython.com/documenting-python-code/';
        this.callbacks.onReady = [function() {
          if (window.onDisqusReady) {
            window.onDisqusReady();
          }
        }];
      };
      var disqus_script_url = 'https://realpython.disqus.com/embed.js';
    </script>
<script src="https://cdn.realpython.com/static/frontend/reader/lazy-disqus.07ee9079f4a3.js" defer></script>
<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async></script>
<script>
    var OneSignal = window.OneSignal || [];
    OneSignal.push(function() {
      OneSignal.init({
        appId: "c0081e20-a523-42bb-b0ac-04c5a9e8bf40"
      });
    });
  </script>
<script type="application/ld+json">
  {
    "@context": "http://schema.org",
    "@type": "Article",
    "headline": "Documenting Python Code: A Complete Guide",
    
    "image": {
      "@type": "ImageObject",
      "url": "https://files.realpython.com/media/Documenting-Python-Code_Watermarked.0b26408a1b7f.jpg",
      "width": 1920,
      "height": 1080
    },
    
    "mainEntityOfPage": {
      "@type": "WebPage",
      "@id": "https://realpython.com/documenting-python-code/"
    },
    "datePublished": "2018-07-25T14:00:00+00:00",
    "dateModified": "2022-03-18T18:13:57.870032+00:00",
     "publisher": {
      "@type": "Organization",
      "name": "Real Python",
      "logo": {
        "@type": "ImageObject",
        "url": "https://cdn.realpython.com/static/real-python-logo-square-tiny.b2452b6d3823.png",
        "width": 60,
        "height": 60
      }
    },
    "author": {
      "@type": "Organization",
      "name": "Real Python",
      "url": "https://realpython.com",
      "logo": "https://cdn.realpython.com/static/real-python-logo-square.146e987bf77c.png"
    },
    "description": "A complete guide to documenting Python code. Whether you\u0027re documenting a small script or a large project, whether you\u0027re a beginner or seasoned Pythonista, this guide will cover everything you need to know."
  }
  </script>
<script>
  var _dcq = _dcq || [];
  var _dcs = _dcs || {};
  _dcs.account = '6214500';

  (function() {
    var dc = document.createElement('script');
    dc.type = 'text/javascript'; dc.async = true;
    dc.src = '//tag.getdrip.com/6214500.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(dc, s);
  })();
</script>
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '2220911568135371');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=2220911568135371&ev=PageView&noscript=1"
/></noscript>
<script type="text/javascript">(function(){window['__CF$cv$params']={r:'6f641124ea183b81',m:'ITL4KDoEb_yyBGXgTqI1gLGnekaCbU7YIk2WwKZqq1s-1649012634-0-AV85XNDSwUyiPeZBH9TT2TH/HZP3ZgqFWQ7OnJ3gm4jr/RSzwIfUhPGgeDEsycVzAtlk4cL06kE1vBZ9Zgh5+dQkfDe5+UMzNNAG0VbZkOXGKWo8ChagOBmAEPpuL1Gpq03Az5FUSRNlBPD4vVyB/zw=',s:[0x610682d669,0x6020731f55],}})();</script></body>
</html>

