parcelRequire = function(e, r, t, n) {
    var i, o = "function" == typeof parcelRequire && parcelRequire,
        u = "function" == typeof require && require;

    function f(t, n) {
        if (!r[t]) {
            if (!e[t]) {
                var i = "function" == typeof parcelRequire && parcelRequire;
                if (!n && i) return i(t, !0);
                if (o) return o(t, !0);
                if (u && "string" == typeof t) return u(t);
                var c = new Error("Cannot find module '" + t + "'");
                throw c.code = "MODULE_NOT_FOUND", c
            }
            p.resolve = function(r) {
                return e[t][1][r] || r
            }, p.cache = {};
            var l = r[t] = new f.Module(t);
            e[t][0].call(l.exports, p, l, l.exports, this)
        }
        return r[t].exports;

        function p(e) {
            return f(p.resolve(e))
        }
    }
    f.isParcelRequire = !0, f.Module = function(e) {
        this.id = e, this.bundle = f, this.exports = {}
    }, f.modules = e, f.cache = r, f.parent = o, f.register = function(r, t) {
        e[r] = [function(e, r) {
            r.exports = t
        }, {}]
    };
    for (var c = 0; c < t.length; c++) try {
        f(t[c])
    } catch (e) {
        i || (i = e)
    }
    if (t.length) {
        var l = f(t[t.length - 1]);
        "object" == typeof exports && "undefined" != typeof module ? module.exports = l : "function" == typeof define && define.amd ? define(function() {
            return l
        }) : n && (this[n] = l)
    }
    if (parcelRequire = f, i) throw i;
    return f
}({
    "T0VR": [function(require, module, exports) {

    }, {}],
    "H99C": [function(require, module, exports) {
        "use strict";
        require("./style.scss"), void 0 !== window.jQuery && ($.fn.jselect_search = function(e) {
            var t = $.extend({
                placeholder: "Search here",
                fillable: !1,
                searchable: !0,
                on_top_edge: !1,
                on_bottom_edge: !1,
                on_change: !1,
                on_active: !1,
                on_clear_reflect: [],
                disable_text_update: !1,
                on_created: !1
            }, e);
            return $(this).each(function() {
                var e = void 0 !== $(this).attr("data-placeholder") ? $(this).attr("data-placeholder") : t.placeholder;
                $(this).addClass("select-search").attr("data-clear-simblings", t.on_clear_reflect.join(",")).append('<a href="#" class="trigger"></a>\n          <div class="sub-wrapper"><div class="select-search-sub">\n            '.concat(t.searchable ? '<input class="select-search-input" type="text" placeholder="' + e + '" name="select_search_' + $(this).index() + '">' : "", '\n            <div class="load-prev"></div>\n            <ul></ul>\n          <div class="load-next"></div>')).find(".select-search-sub ul").on("scroll", function() {
                    $(this).innerHeight() > 300 && (this.offsetHeight + this.scrollTop == this.scrollHeight && t.on_bottom_edge && "function" == typeof t.on_bottom_edge && t.on_bottom_edge($(this).closest(".select-search-sub")), 0 == this.scrollTop && t.on_top_edge && "function" == typeof t.on_top_edge && t.on_top_edge($(this).closest(".select-search-sub")))
                }), t.disable_text_update && $(this).addClass("disable-text-update");
                var s, a, c, l, i = $(this).find("select option:selected").text();
                $(this).find(".trigger").text(i), $(this).find("select option").each(function() {
                    "" != $(this).val() && $(this).closest(".select-search").find(".select-search-sub ul").append('<li><a  data-value="' + $(this).val() + '">' + $(this).text() + "</a></li>")
                }), $(this).find(".trigger").on("click", function(e) {
                    e.preventDefault(), $(this).closest(".select-search").hasClass("active") ? ($(".select-search.active select").trigger("focusout"), $(".select-search.active").removeClass("active")) : ($(".select-search.active").removeClass("active"), $(this).closest(".select-search").find(".select-search-sub li").show(), $(this).closest(".select-search").addClass("active").find(".select-search-sub input").val(""), t.on_active && "function" == typeof t.on_active && t.on_active($(this).closest(".select-search")))
                }), $(this).find("select").on("change", function() {
                    t.on_change && "function" == typeof t.on_change && t.on_change($(this))
                }), $(this).find(".select-search-sub input").on("input", (s = function() {
                    if (t.searchable && "function" != typeof t.searchable) {
                        var e = $(this).val().toLowerCase();
                        $(this).closest(".select-search").find(".select-search-sub ul li").hide().filter(function() {
                            return $(this).find("a").text().toLowerCase().indexOf(e) > -1
                        }).fadeIn(200)
                    }
                    t.searchable && "function" == typeof t.searchable && t.searchable($(this).val())
                }, a = 500, function() {
                    var e = this,
                        t = arguments,
                        i = c && !l;
                    clearTimeout(l), l = setTimeout(function() {
                        l = null, c || s.apply(e, t)
                    }, a), i && s.apply(e, t)
                })), $(this).find(".select-search-sub input").on("keydown", function(e) {
                    32 != e.keyCode && 13 != e.which && 13 != e.keyCode || !t.fillable || ($(this).closest(".select-search").find(".trigger").text($(this).val()), $(this).closest(".select-search").find(".select-search-sub ul").append('<li><a href="#" data-value="' + $(this).val() + '">' + $(this).val() + "</a></li>"), $(this).closest(".select-search").find("select").append('<option value="' + $(this).val() + '">' + $(this).val() + "</option>").val($(this).val()), $(".select-search.active").removeClass("active"))
                }), t.on_created && t.on_created($(this))
            })
        }, $(document).on("mousedown touchstart", function(e) {
            var t = $(".select-search-sub:visible,.clear-btn,.trigger,.app-loader,#app-loader-content");
            t.is(e.target) || 0 !== t.has(e.target).length || ($(".select-search.active select").trigger("focusout"), $(".select-search.active").removeClass("active"))
        }), $(document).on("click", ".select-search-sub ul li a", function(e) {
            e.preventDefault();
            var t = $(this);
            $(this).closest(".select-search").find('select option[value="' + $(this).attr("data-value") + '"]').prop("selected", !0).closest("select").trigger("change"), $(this).closest(".select-search").hasClass("disable-text-update") || $(".select-search.active").removeClass("active").find(".trigger").html('<span class="clear-btn"></span> ' + $(this).text()).find("span.clear-btn").on("click", function(e) {
                e.stopPropagation(), $(this).closest(".select-search").find("select").val("").trigger("change"), $(this).closest(".trigger").html($(this).closest(".select-search").find('select option[value=""]').text()), $(".select-search.active").removeClass("active");
                var s = t.closest(".select-search").attr("data-clear-simblings");
                $.each(s.split(","), function(e, t) {
                    $(t).find(".trigger").html($(t).find('select option[value=""]').text()), $(t).find("select").val("")
                })
            })
        }));
    }, {
        "./style.scss": "T0VR"
    }]
}, {}, ["H99C"], null)
//# sourceMappingURL=src.bfb40cc8.js.map