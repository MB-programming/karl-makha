<!doctype html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="" id="meta-description">
<meta property="og:type"        content="article">
<meta property="og:title"       content="" id="og-title">
<meta property="og:description" content="" id="og-description">
<meta property="og:image"       content="" id="og-image">
<title id="page-title">مقال | مخازن العناية</title>

<link rel="icon" href="/favicon.jpeg">
<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

<style>
*, *::before, *::after { box-sizing: border-box; }
body { font-family: 'Tajawal', sans-serif; margin:0; padding:0; background:#f5f5f5; color:#333; }
a { text-decoration:none; color:#007bff; }

/* ===== HEADER ===== */
.site-header {
  position: fixed; top:0; right:0; left:0; z-index:999;
  padding: 14px 24px;
  background: rgba(0,0,0,0.85);
  backdrop-filter: blur(10px);
  transition: background .3s, padding .3s, box-shadow .3s;
}
.site-header.scrolled {
  background: rgba(255,255,255,0.97);
  box-shadow: 0 2px 20px rgba(0,0,0,0.12);
  padding: 8px 24px;
}
.header-inner { display:flex; align-items:center; justify-content:space-between; max-width:1200px; margin:0 auto; }
.header-logo img { height:48px; width:auto; }
.site-header:not(.scrolled) .header-logo img { filter: brightness(0) invert(1); }
.site-header.scrolled .header-logo img { filter: none; }
.header-nav { display:flex; align-items:center; gap:18px; }
.header-nav a { color:#fff; font-size:15px; font-weight:500; transition:color .2s; }
.site-header.scrolled .header-nav a { color:#222; }
.header-nav a:hover { color:#FFCF06; }
.site-header.scrolled .header-nav a:hover { color:#B8860B; }
.header-nav .nav-home {
  background:#FFCF06; color:#000 !important;
  padding:7px 18px; border-radius:50px; font-weight:700; font-size:14px;
}
.header-nav .nav-home:hover { background:#e6b800; }

/* ===== HERO ===== */
.hero-section {
  background: linear-gradient(rgba(0,0,0,0.65),rgba(0,0,0,0.65)), #111 center/cover no-repeat;
  padding: 130px 20px 80px;
  color:#fff; text-align:center;
}
.hero-section h1 { font-size:38px; margin:0 0 14px; font-weight:800; line-height:1.4; }
.hero-section p  { font-size:18px; color:#ddd; margin:0; max-width:700px; margin-inline:auto; line-height:1.7; }

/* ===== META BAR ===== */
.article-meta {
  display:flex; flex-wrap:wrap; gap:14px;
  justify-content:center; align-items:center;
  font-size:14px; color:#666;
  padding: 22px 15px 0;
  max-width:900px; margin:0 auto;
}
.meta-category {
  background:#FFCF06; color:#000;
  padding:4px 14px; border-radius:50px;
  font-weight:700; font-size:13px;
}
.meta-item { display:flex; align-items:center; gap:6px; }
.meta-item i { color:#007bff; font-size:13px; }

/* ===== ARTICLE CONTENT ===== */
.article-wrap { max-width:900px; margin:0 auto; padding:30px 20px 60px; }

.article-cover {
  width:100%; border-radius:14px;
  overflow:hidden; margin:28px 0 36px;
  box-shadow:0 4px 20px rgba(0,0,0,0.12);
}
.article-cover img { width:100%; display:block; }

.article-title {
  font-size:32px; font-weight:800;
  color:#111; margin:0 0 24px;
  line-height:1.5;
}

.article-body {
  line-height:2; font-size:18px; color:#444;
}
.article-body h2, .article-body h3 { margin-top:36px; color:#222; }
.article-body p  { margin:0 0 20px; }
.article-body img { max-width:100%; border-radius:10px; margin:20px 0; display:block; }
.article-body ul, .article-body ol { padding-right:24px; margin:0 0 20px; }
.article-body blockquote {
  border-right:4px solid #FFCF06;
  margin:20px 0; padding:12px 20px;
  background:#fffbea; color:#555;
  font-style:italic;
}

.article-tags { margin-top:36px; display:flex; flex-wrap:wrap; gap:8px; }
.article-tags span {
  background:#eef2ff; color:#3d5af1;
  padding:4px 12px; border-radius:20px; font-size:13px;
}

.article-footer {
  margin-top:60px; padding-top:20px;
  border-top:1px solid #e0e0e0;
  text-align:center; color:#aaa; font-size:14px;
}

/* ===== SKELETON LOADING ===== */
.skeleton { background:linear-gradient(90deg,#e8e8e8 25%,#f4f4f4 50%,#e8e8e8 75%); background-size:200% 100%; animation:shimmer 1.4s infinite; border-radius:6px; }
@keyframes shimmer { 0%{background-position:200% 0} 100%{background-position:-200% 0} }

@media(max-width:600px){
  .hero-section h1   { font-size:26px; }
  .hero-section      { padding:100px 16px 60px; }
  .article-body      { font-size:16px; }
  .article-title     { font-size:24px; }
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
      <a href="/" class="nav-home"><i class="fas fa-home"></i> الرئيسية</a>
    </nav>
  </div>
</header>

<!-- ===== HERO ===== -->
<section class="hero-section" id="hero-section">
  <div>
    <h1 id="hero-title" class="skeleton" style="min-height:44px;max-width:600px;margin:0 auto 14px"></h1>
    <p  id="hero-excerpt"></p>
  </div>
</section>

<!-- ===== META BAR ===== -->
<div class="article-meta" id="article-meta" style="display:none">
  <span class="meta-category" id="meta-category"></span>
  <span class="meta-item" id="meta-author-wrap">
    <i class="fa fa-user"></i>
    <span id="meta-author"></span>
  </span>
  <span class="meta-item" id="meta-date-wrap">
    <i class="fa fa-calendar-alt"></i>
    <span id="meta-date"></span>
  </span>
  <span class="meta-item">
    <i class="fa fa-eye"></i>
    <span id="meta-views">0</span> مشاهدة
  </span>
</div>

<!-- ===== ARTICLE ===== -->
<article class="article-wrap">

  <h1 class="article-title" id="article-title" style="display:none"></h1>

  <div class="article-cover" id="article-cover-wrap" style="display:none">
    <img id="article-cover" alt="">
  </div>

  <div id="article-body" class="article-body">
    <!-- skeleton -->
    <p class="skeleton" style="height:18px;margin-bottom:14px"></p>
    <p class="skeleton" style="height:18px;margin-bottom:14px;width:85%"></p>
    <p class="skeleton" style="height:18px;margin-bottom:14px;width:92%"></p>
  </div>

  <div id="article-tags" class="article-tags" style="display:none"></div>

  <div class="article-footer">
    © 2025 مخازن العناية. جميع الحقوق محفوظة.
  </div>

</article>

<script>
(function () {
  /* ── header scroll ── */
  const header = document.getElementById('site-header');
  window.addEventListener('scroll', () => header.classList.toggle('scrolled', scrollY > 60));

  /* ── slug from URL ── */
  const slug = new URLSearchParams(location.search).get('slug');
  if (!slug) {
    showError('رابط غير صحيح', 'لم يتم تحديد مقال في الرابط');
    return;
  }

  /* ── fetch article ── */
  fetch('/api/articles_api.php?slug=' + encodeURIComponent(slug))
    .then(r => r.json())
    .then(d => {
      if (!d.success || !d.data) { showError('تعذّر تحميل المقال', d.message || 'المقال غير موجود'); return; }
      render(d.data);
    })
    .catch(() => showError('خطأ في الاتصال', 'تعذّر الوصول إلى الخادم'));

  /* ── render ── */
  function render(a) {
    /* HERO */
    const heroTitle = document.getElementById('hero-title');
    heroTitle.textContent = a.title || '';
    heroTitle.classList.remove('skeleton');
    heroTitle.style.minHeight = '';

    document.getElementById('hero-excerpt').textContent = a.excerpt || '';

    if (a.cover_image) {
      document.getElementById('hero-section').style.backgroundImage =
        'linear-gradient(rgba(0,0,0,0.65),rgba(0,0,0,0.65)), url("' + a.cover_image + '")';
    }

    /* META BAR */
    const metaBar = document.getElementById('article-meta');
    metaBar.style.display = '';

    const catEl = document.getElementById('meta-category');
    if (a.category) { catEl.textContent = a.category; } else { catEl.style.display = 'none'; }

    const authorEl = document.getElementById('meta-author');
    if (a.author_name) { authorEl.textContent = a.author_name; } else { document.getElementById('meta-author-wrap').style.display = 'none'; }

    const dateEl = document.getElementById('meta-date');
    if (a.published_at) {
      const d = new Date(a.published_at);
      dateEl.textContent = d.toLocaleDateString('ar-SA', { year:'numeric', month:'long', day:'numeric' });
    } else {
      document.getElementById('meta-date-wrap').style.display = 'none';
    }

    document.getElementById('meta-views').textContent = (a.view_count || 0).toLocaleString('ar-SA');

    /* TITLE */
    const titleEl = document.getElementById('article-title');
    titleEl.textContent = a.title || '';
    titleEl.style.display = a.title ? '' : 'none';

    /* COVER IMAGE */
    if (a.cover_image) {
      document.getElementById('article-cover').src = a.cover_image;
      document.getElementById('article-cover-wrap').style.display = '';
    }

    /* BODY */
    document.getElementById('article-body').innerHTML = a.body || '';

    /* TAGS */
    if (a.tags) {
      const tagsWrap = document.getElementById('article-tags');
      tagsWrap.style.display = '';
      a.tags.split(',').forEach(t => {
        t = t.trim();
        if (t) { const s = document.createElement('span'); s.textContent = t; tagsWrap.appendChild(s); }
      });
    }

    /* SEO */
    document.title = a.seo_title || a.title || 'مقال | مخازن العناية';
    setMeta('meta-description', a.seo_description || a.excerpt || '');
    setOg('og-title',       a.og_title       || a.seo_title    || a.title || '');
    setOg('og-description', a.og_description || a.seo_description || a.excerpt || '');
    setOg('og-image',       a.og_image       || a.cover_image  || '');
  }

  function setMeta(id, val) {
    const el = document.getElementById(id);
    if (el && val) el.setAttribute('content', val);
  }
  function setOg(id, val) { setMeta(id, val); }

  function showError(title, msg) {
    const heroTitle = document.getElementById('hero-title');
    heroTitle.textContent = title;
    heroTitle.classList.remove('skeleton');
    heroTitle.style.minHeight = '';
    document.getElementById('hero-excerpt').textContent = msg;
    document.getElementById('article-body').innerHTML =
      '<p style="text-align:center;color:#c00;padding:60px 0;font-size:17px"><i class="fas fa-exclamation-circle"></i> ' + msg + '</p>';
  }
}());
</script>

</body>
</html>
