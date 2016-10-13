/**
 * @module       RD Calendar
 * @author       Evgeniy Gusarov
 * @see          https://ua.linkedin.com/pub/evgeniy-gusarov/8a/a40/54a
 * @version      1.0.0
 */
!function (e, t, a, n) {
    "use strict";
    function s(t, a) {
        this.options = e.extend({}, s.Defaults, a), this.$element = e(t);
        var n = this.$element.find("." + this.options.classes.table).data("date");
        this.$element.data("currentDate", n ? new Date(n) : new Date), this.$element.data("todayDate", new Date), this.evt = {}, this._handlers = {
            "rdc.next": this.next,
            "rdc.prev": this.prev,
            "rdc.refresh": e.proxy(this.refresh, this)
        }, this.initialize()
    }

    s.Defaults = {
        days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
        months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
        classes: {
            base: "rd-calendar",
            next: "rdc-next",
            prev: "rdc-prev",
            year: "rdc-fullyear",
            date: "rdc-date",
            day: "rdc-day",
            month: "rdc-month",
            time: "rdc-time",
            event: "rdc-event",
            events: "rdc-events",
            events_close: "rdc-events_close",
            table: "rdc-table",
            table_today: "rdc-table_today",
            table_event: "rdc-table_event",
            table_events: "rdc-table_events",
            table_has_events: "rdc-table_has-events",
            table_events_count: "rdc-table_events-count",
            table_day: "rdc-table_day",
            table_date: "rdc-table_date",
            table_next: "rdc-table_next",
            table_prev: "rdc-table_prev",
            today_date: "rdc-today_date",
            today_month: "rdc-today_month",
            today_year: "rdc-today_fullyear",
            today_day: "rdc-today_day"
        }
    }, s.prototype.initialize = function () {
        this.$element.trigger("rdc.initialize"), this.read(), this.create(), this.watch(), this.$element.trigger("rdc.initialized")
    }, s.prototype.create = function () {
        var t = this;
        t.$element.find("." + t.options.classes.today_date).each(function () {
            e(this).text(t.getTodayDate())
        }).end().find("." + t.options.classes.today_month).each(function () {
            e(this).text(t.getTodayMonth())
        }).end().find("." + t.options.classes.today_year).each(function () {
            e(this).text(t.getTodayYear())
        }).end().find("." + t.options.classes.today_day).each(function () {
            e(this).text(t.getTodayDay())
        }), t.refresh()
    }, s.prototype.watch = function () {
        var t = this;
        t.$element.on(t._handlers).find("." + t.options.classes.next).on("click", function () {
            t.$element.trigger("rdc.next"), t.$element.trigger("rdc.refresh")
        }).end().find("." + t.options.classes.prev).on("click", function () {
            t.$element.trigger("rdc.prev"), t.$element.trigger("rdc.refresh")
        }).end().find("." + t.options.classes.events_close).on("click", function () {
            t.$element.removeClass("show-events"), t.$element.find("." + t.options.classes.event + ", ." + t.options.classes.table_event).removeClass("active")
        }).end().delegate("." + t.options.classes.table_has_events, "click", function () {
            t.$element.find("." + t.options.classes.table_has_eventsm + ", ." + t.options.classes.event).removeClass("active");
            var a = e(this).find("." + t.options.classes.table_date).data("date");
            for (var n in t.evt[a])t.evt[a][n].addClass("active");
            e(this).addClass("active"), t.$element.addClass("show-events")
        })
    }, s.prototype.read = function () {
        var t = this.options, a = this;
        this.$element.find("." + t.classes.event).each(function () {
            var t = e(this), n = new Date(t.data("date")).valueOf();
            n in a.evt || (a.evt[n] = []), a.evt[n].push(t)
        })
    }, s.prototype.next = function () {
        var t = e(this), a = t.data("currentDate");
        a = 11 == a.getMonth() ? new Date(a.getFullYear() + 1, 0, 1) : new Date(a.getFullYear(), a.getMonth() + 1, 1), t.data("currentDate", a)
    }, s.prototype.prev = function () {
        var t = e(this), a = t.data("currentDate");
        a = 0 == a.getMonth() ? new Date(a.getFullYear() - 1, 11, 1) : new Date(a.getFullYear(), a.getMonth() - 1, 1), t.data("currentDate", a)
    }, s.prototype.getTodayYear = function () {
        return this.$element.data("todayDate").getFullYear()
    }, s.prototype.getTodayDay = function () {
        return this.options.days[this.$element.data("todayDate").getDay()]
    }, s.prototype.getTodayDate = function () {
        return this.$element.data("todayDate").getDate()
    }, s.prototype.getTodayMonth = function () {
        return this.options.months[this.$element.data("todayDate").getMonth()]
    }, s.prototype.getMonth = function () {
        return this.options.months[this.$element.data("currentDate").getMonth()]
    }, s.prototype.getYear = function () {
        return this.$element.data("currentDate").getFullYear()
    }, s.prototype.refresh = function () {
        var t = this, a = this.options, s = this.$element.find("." + a.classes.table), r = e("<table/>");
        t.$element.find("." + t.options.classes.month).each(function () {
            var a = e(this);
            a.text(t.getMonth())
        }).end().find("." + t.options.classes.year).each(function () {
            var a = e(this);
            a.text(t.getYear())
        });
        for (var d = e("<tr/>"), o = 0; o < a.days.length; o++)d.append(e("<th/>", {
            "class": a.classes.table_day,
            text: a.days[o]
        }));
        r.append(d);
        for (var l = this.$element.data("currentDate"), i = new Date(l.getFullYear(), l.getMonth() + 1, 0).getDate(), c = new Date(l.getFullYear(), l.getMonth(), 0).getDate(), h = new Date(l.getFullYear(), l.getMonth(), 1).getDay(), u = 1, o = 0; 7 > o; o++) {
            d = e("<tr/>");
            for (var p = 0; 7 > p; p++) {
                var v, y = 7 * o + p + 1, f = e("<td/>"), g = n, _ = n, m = e("<div/>", {"class": a.classes.table_date}), b = new Date;
                if (b.setHours(0), b.setMinutes(0), b.setSeconds(0), b.setMilliseconds(0), 0 == p && y > i + h)break;
                1 > y - h ? (m.text(c + (y - h)).addClass(a.classes.table_prev), v = new Date(l.getFullYear(), l.getMonth() - 1, c + (y - h))) : i + h >= y ? (m.text(y - h), v = new Date(l.getFullYear(), l.getMonth(), y - h)) : (m.text(u).addClass(a.classes.table_next), v = new Date(l.getFullYear(), l.getMonth() + 1, u++)), v.valueOf() == b.valueOf() && m.addClass(a.classes.table_today), v.valueOf()in this.evt && (f.addClass(a.classes.table_has_events), g = e("<div/>", {"class": a.classes.table_events_count}).text(this.evt[v.valueOf()].length), _ = e("<ul/>", {"class": a.classes.table_events}), e(this.evt[v.valueOf()]).each(function () {
                    _.append(e("<li/>", {"class": a.classes.table_event}).html(e(this).html()))
                })), f.append(m.data("date", v.valueOf())), g && f.append(g), _ && f.append(_), d.append(f)
            }
            "" != d.html() && r.append(d)
        }
        var D = s.find("table");
        D.length ? D.replaceWith(r) : r.appendTo(s)
    }, e.fn.rdCalendar = function (t) {
        return this.each(function () {
            e(this).data("rdCalendar") || e(this).data("rdCalendar", new s(this, t))
        })
    }, e.fn.rdCalendar.Constructor = s
}(window.jQuery, window, document);
