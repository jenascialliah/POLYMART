'use strict';
const esc = v => String(v ?? '').replace(/[&<>"']/g,c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
const CART_KEY = 'polymartGuestCart_v1';
const ORDER_KEY = 'polymartGuestOrders_v1';
function readList(key) { try { const v=JSON.parse(sessionStorage.getItem(key)||'[]'); return Array.isArray(v)?v:[]; } catch { return []; } }
function saveList(key,v) { try { sessionStorage.setItem(key,JSON.stringify(v)); return true; } catch { alert('Browser storage is unavailable or full. Try clearing demo data.'); return false; } }
function safeImage(v) { const s=String(v||'').replace(/^\.\//,''); return /^elements\/[a-zA-Z0-9 _().-]+\.(png|jpe?g|webp)$/i.test(s)?s:'elements/pm_logo.png'; }
function cleanItem(i) { if (!i || typeof i.name!=='string' || !Number.isFinite(Number(i.price)) || Number(i.price)<0 || !Number.isInteger(Number(i.quantity)) || Number(i.quantity)<1) return null; return {name:i.name.slice(0,150),price:Math.min(100000,Number(i.price)),quantity:Math.min(99,Number(i.quantity)),image:safeImage(i.image)}; }
function getCart() { return readList(CART_KEY).map(cleanItem).filter(Boolean); }
function getOrders() { return readList(ORDER_KEY).filter(o=>o && Number.isSafeInteger(o.orderId) && Array.isArray(o.items)).map(o=>({...o,items:o.items.map(cleanItem).filter(Boolean)})); }
function resetDemo(){if(confirm('Clear your demo cart and purchase history in this tab?')){sessionStorage.removeItem(CART_KEY);sessionStorage.removeItem(ORDER_KEY);location.href='main_pm.php';}}
function money(n){return '₱'+Number(n).toFixed(2);}
document.addEventListener('DOMContentLoaded',()=>{
  document.querySelectorAll('.search-form').forEach(form=>form.addEventListener('submit',e=>{e.preventDefault();const q=form.querySelector('input').value.trim();if(typeof searchProducts==='function')searchProducts(q);else location.href='main_pm.php?q='+encodeURIComponent(q)+'#Products';}));
});
