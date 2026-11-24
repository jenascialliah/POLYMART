const esc = v => String(v ?? '').replace(/[&<>"']/g,c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
const originalFetch=window.fetch.bind(window);
window.fetch=(url,opts={})=>{const target=new URL(url,location.href);if(target.origin===location.origin && (opts.method||'GET').toUpperCase()==='POST'){opts={...opts,headers:{...opts.headers,'X-CSRF-Token':document.querySelector('meta[name=csrf-token]').content}};}return originalFetch(url,opts);};
async function polyLogout(){if(!confirm('Log out?'))return;try{const r=await fetch('logout.php',{method:'POST'});if(!r.ok)throw Error();sessionStorage.clear();location.href='pm_landing_pg.php';}catch{alert('Logout failed. Please retry.');}}
async function autoRedirectIfLoggedIn(){const r=await fetch('session.php');const d=await r.json();if(d.email)location.href='main_pm.php';}
