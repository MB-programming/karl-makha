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
*, *::before, *::after { box-sizing: border-box; }
body { font-family: 'Tajawal', sans-serif; margin:0; padding:0; background:#f9f9f9; color:#333; }
a { text-decoration:none; color:#007bff; }
.container { max-width: 900px; margin: auto; padding: 30px 15px; }

/* ===== HEADER ===== */
.site-header {
  position: fixed;
  top: 0; right: 0; left: 0;
  z-index: 999;
  padding: 14px 24px;
  background: rgba(0,0,0,0.85);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  transition: background 0.3s, padding 0.3s, box-shadow 0.3s;
}
.site-header.scrolled {
  background: rgba(255,255,255,0.97);
  box-shadow: 0 2px 20px rgba(0,0,0,0.12);
  padding: 8px 24px;
}
.header-inner {
  display: flex;
  align-items: center;
  justify-content: space-between;
  max-width: 1200px;
  margin: 0 auto;
}
.header-logo img { height: 48px; width: auto; }
.site-header:not(.scrolled) .header-logo img { filter: brightness(0) invert(1); }
.site-header.scrolled .header-logo img { filter: none; }
.header-nav { display: flex; align-items: center; gap: 18px; }
.header-nav a {
  color: #fff;
  font-size: 15px;
  font-weight: 500;
  transition: color 0.2s;
}
.site-header.scrolled .header-nav a { color: #222; }
.header-nav a:hover { color: #FFCF06; }
.site-header.scrolled .header-nav a:hover { color: #B8860B; }
.header-nav .nav-home {
  background: #FFCF06;
  color: #000 !important;
  padding: 7px 18px;
  border-radius: 50px;
  font-weight: 700;
  font-size: 14px;
}
.header-nav .nav-home:hover { background: #e6b800; color: #000 !important; }

/* ===== HERO ===== */
.hero-section {
  background: linear-gradient(rgba(0,0,0,0.65), rgba(0,0,0,0.65)), #111 center/cover no-repeat;
  padding: 120px 15px 70px;
  color: #fff;
  text-align: center;
}
.hero-section h1 { font-size: 38px; margin: 0 0 12px; font-weight: 800; }
.hero-section p { font-size: 18px; color: #eee; margin: 0; }

/* ===== ARTICLE ===== */
.article-meta {
  display: flex;
  flex-wrap: wrap;
  gap: 15px;
  justify-content: center;
  font-size: 14px;
  color: #666;
  margin: 24px 0 10px;
}
.article-meta i { margin-left: 5px; color:#007bff; }
.article-meta .meta-category {
  background: #FFCF06;
  color: #000;
  padding: 3px 12px;
  border-radius: 50px;
  font-weight: 700;
  font-size: 13px;
}
.article-cover img {
  width: 100%;
  border-radius: 12px;
  margin: 20px 0 30px;
  display: block;
}
.article-body {
  line-height: 1.9;
  font-size: 18px;
  color: #444;
}
.article-body h2, .article-body h3 { margin-top: 30px; color: #222; }
.article-body img { max-width: 100%; border-radius: 10px; margin: 15px 0; }
.article-footer {
  margin-top: 60px;
  padding-top: 20px;
  border-top: 1px solid #ddd;
  text-align: center;
  color: #999;
  font-size: 14px;
}

@media(max-width:600px){
  .hero-section h1 { font-size: 26px; }
  .hero-section { padding: 100px 15px 50px; }
  .article-body { font-size: 16px; }
}
</style>
</head>

<body>

<!-- ===== HEADER ===== -->
<header class="site-header" id="site-header">
  <div class="header-inner">
    <a href="/" class="header-logo">
      <img src="/logob.webp" alt="مخازن العناية" />
    </a>
    <nav class="header-nav">
      <a href="https://wa.me/966920029921" title="واتساب">
        <i class="fa-brands fa-whatsapp" style="font-size:20px"></i>
      </a>
      <a href="tel:+966920029921">
        <i class="fas fa-phone" style="font-size:16px"></i> 92002 9921
      </a>
      <a href="/" class="nav-home">
        <i class="fas fa-home"></i> الرئيسية
      </a>
    </nav>
  </div>
</header>

<!-- ===== HERO ===== -->
<section class="hero-section" id="hero-section">
  <div class="container">
    <h1 id="hero-title">...</h1>
    <p id="hero-excerpt">...</p>
  </div>
</section>

<!-- ===== ARTICLE ===== -->
<section class="container article-section">

  <div class="article-meta">
    <span class="meta-category" id="article-category"></span>
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

<script>
(function () {
  const header = document.getElementById('site-header');
  window.addEventListener('scroll', function () {
    header.classList.toggle('scrolled', window.scrollY > 60);
  });

  const params = new URLSearchParams(window.location.search);
  const slug = params.get('slug');

  fetch('/api/get_data.php')
    .then(r => r.json())
    .then(d => {
      const article = d.articles.find(a => a.slug === slug);
      if (!article) return;

      document.getElementById('hero-title').textContent   = article.title   || '';
      document.getElementById('hero-excerpt').textContent = article.excerpt  || '';

      if (article.cover_image) {
        document.getElementById('hero-section').style.backgroundImage =
          'linear-gradient(rgba(0,0,0,0.65),rgba(0,0,0,0.65)), url("' + article.cover_image + '")';
      }

      document.getElementById('article-title').textContent    = article.title        || '';
      document.getElementById('article-category').textContent = article.category     || '';
      document.getElementById('article-author').textContent   = article.author_name  || '';
      document.getElementById('article-date').textContent     = article.published_at || '';
      document.getElementById('article-views').textContent    = article.view_count   || 0;

      const cover = document.getElementById('article-cover');
      if (article.cover_image) {
        cover.src = article.cover_image;
      } else {
        cover.parentElement.style.display = 'none';
      }

      document.getElementById('article-body').innerHTML = article.body || '';
      document.title = article.seo_title || article.title || 'مقال';

      if (article.seo_description) {
        document.querySelector('meta[name="description"]').setAttribute('content', article.seo_description);
      }

      const catEl = document.getElementById('article-category');
      if (!article.category) catEl.style.display = 'none';
    });
}());
</script>

</body>
</html>