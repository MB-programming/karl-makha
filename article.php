<!doctype html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">

<link rel="icon" href="/favicon.jpeg">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;700;800&display=swap" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

<style>
body { font-family: 'Tajawal', sans-serif; margin:0; padding:0; background:#f9f9f9; color:#333; }
a { text-decoration:none; color:#007bff; }
.container { max-width: 900px; margin: auto; padding: 30px 15px; }

.hero-section {
  background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), #000 url('/pattern-hero.webp') no-repeat center/cover;
  padding: 80px 15px 60px;
  color: #fff;
  text-align: center;
}
.hero-section h1 { font-size: 38px; margin-bottom: 10px; font-weight: 800; }
.hero-section p { font-size: 18px; color: #eee; }

.article-meta {
  display: flex;
  flex-wrap: wrap;
  gap: 15px;
  justify-content: center;
  font-size: 14px;
  color: #666;
  margin-bottom: 20px;
}

.article-meta i { margin-left: 5px; color:#007bff; }

.article-cover img {
  width: 100%;
  border-radius: 12px;
  margin: 30px 0;
}

.article-body {
  line-height: 1.8;
  font-size: 18px;
  color: #444;
}

.article-body h2, .article-body h3 { margin-top: 25px; }

.article-body img { max-width: 100%; border-radius: 10px; margin: 15px 0; }

.article-footer {
  margin-top: 50px;
  padding-top: 20px;
  border-top: 1px solid #ddd;
  text-align: center;
  color: #999;
  font-size: 14px;
}

@media(max-width:600px){
  .hero-section h1 { font-size:28px; }
  .article-body { font-size:16px; }
}
</style>

<script>
// Get slug from query parameter ?slug=...
const params = new URLSearchParams(window.location.search);
const slug = params.get('slug');

fetch("/api/get_data.php")
.then(r => r.json())
.then(d => {
  const article = d.articles.find(a => a.slug === slug);
  if(!article) return;
  
  head = document.createElement("div")
  head.innerHTML = article.head_html
  
  while (head.firstChild) {
    document.head.appendChild(head.firstChild);
  }

  document.getElementById("hero-title").innerHTML = article.title;
  document.getElementById("hero-excerpt").innerHTML = article.excerpt;

  document.getElementById("article-title").innerHTML = article.title;
  document.getElementById("article-category").innerHTML = article.category || "";
  document.getElementById("article-author").innerHTML = article.author_name || "";
  document.getElementById("article-date").innerHTML = article.published_at || "";
  document.getElementById("article-views").innerHTML = article.view_count || 0;

  if(article.cover_image){
    document.getElementById("article-cover").src = article.cover_image;
  } else {
    document.getElementById("article-cover").style.display = "none";
  }

  document.getElementById("article-body").innerHTML = article.body || "";

  document.title = article.seo_title || article.title;
});
</script>


</head>

<body>

<!-- HERO -->
<section class="hero-section">
  <div class="container">
    <h1 id="hero-title">...</h1>
    <p id="hero-excerpt">...</p>
  </div>
</section>

<!-- ARTICLE -->
<section class="container article-section">

<div class="article-meta">
  <span id="article-category"></span>
  <span><i class="fa fa-user"></i> <span id="article-author"></span></span>
  <span><i class="fa fa-calendar"></i> <span id="article-date"></span></span>
  <span><i class="fa fa-eye"></i> <span id="article-views"></span></span>
</div>

<h1 id="article-title"></h1>
<div class="article-cover">
  <img id="article-cover" alt="Cover Image">
</div>
<div id="article-body" class="article-body"></div>

<div class="article-footer">
  © 2025 مخازن العناية. جميع الحقوق محفوظة.
</div>

</section>

</body>
</html>