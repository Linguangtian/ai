// 自适应布局

(function (win) {
  var doc = win.document
  var docEl = doc.documentElement
  var tid

  function refreshRem () {
    // 判断如果是阿里聊天页面则不需要设置页面rem，否则阿里样式被覆盖
    if (window.location.pathname.indexOf('alikf') < 0) {
      console.log(window.location)
      var width = docEl.getBoundingClientRect().width
      if (width > 768) { // 最大宽度
        width = 768
      }
      var rem = width / 3.75
      docEl.style.fontSize = rem + 'px'
    }
  }

  win.addEventListener('resize', function () {
    clearTimeout(tid)
    tid = setTimeout(refreshRem, 300)
  }, false)
  win.addEventListener('pageshow', function (e) {
    if (e.persisted) {
      clearTimeout(tid)
      tid = setTimeout(refreshRem, 300)
    }
  }, false)

  refreshRem()
})(window)
