/*!
 * jQuery UI Button 1.11.4
 * http://jqueryui.com
 *
 * Copyright jQuery Foundation and other contributors
 * Released under the MIT license.
 * http://jquery.org/license
 *
 * http://api.jqueryui.com/button/
 */
!function (a) {
    "function" == typeof define && define.amd ? define(["jquery", "./core", "./widget"], a) : a(jQuery)
}
(function (a) {
    var b, c = "ui-button ui-widget ui-state-default ui-corner-all", d = "ui-button-icons-only ui-button-icon-only ui-button-text-icons ui-button-text-icon-primary ui-button-text-icon-secondary ui-button-text-only", e = function () {
        var b = a(this);
        setTimeout(function () {
            b.find(":ui-button").button("refresh")
        }
        , 1)
    }
    , f = function (b) {
        var c = b.name, d = b.form, e = a([]);
        return c && (c = c.replace(/'/g, "\\'"), e = d ? a(d).find("[name='" + c + "'][type=radio]") : a("[name='" + c + "'][type=radio]", b.ownerDocument).filter(function () {
            return!this.form
        }
        )), e
    }
    ;
    return a.widget("ui.button", {version: "1.11.4", defaultElement: "<button>", options: {disabled: null, text: !0, label: null, icons: {primary: null, secondary: null}
        }, _create: function () {
            this.element.closest("form").unbind("reset" + this.eventNamespace).bind("reset" + this.eventNamespace, e), "boolean" != typeof this.options.disabled ? this.options.disabled = !!this.element.prop("disabled") : this.element.prop("disabled", this.options.disabled), this._determineButtonType(), this.hasTitle = !!this.buttonElement.attr("title");
            var d = this, g = this.options, h = "checkbox" === this.type || "radio" === this.type, i = h ? "" : "ui-state-active";
            null === g.label && (g.label = "input" === this.type ? this.buttonElement.val() : this.buttonElement.html()), this._hoverable(this.buttonElement), this.buttonElement.addClass(c).attr("role", "button").bind("mouseenter" + this.eventNamespace, function () {
                g.disabled || this === b && a(this).addClass("ui-state-active")
            }
            ).bind("mouseleave" + this.eventNamespace, function () {
                g.disabled || a(this).removeClass(i)
            }
            ).bind("click" + this.eventNamespace, function (a) {
                g.disabled && (a.preventDefault(), a.stopImmediatePropagation())
            }
            ), this._on({focus: function () {
                    this.buttonElement.addClass("ui-state-focus")
                }
                , blur: function () {
                    this.buttonElement.removeClass("ui-state-focus")
                }
            }), h && this.element.bind("change" + this.eventNamespace, function () {
                d.refresh()
            }
            ), "checkbox" === this.type ? this.buttonElement.bind("click" + this.eventNamespace, function () {
                if (g.disabled)
                    return!1
            }
            ) : "radio" === this.type ? this.buttonElement.bind("click" + this.eventNamespace, function () {
                if (g.disabled)
                    return!1;
                a(this).addClass("ui-state-active"), d.buttonElement.attr("aria-pressed", "true");
                var b = d.element[0];
                f(b).not(b).map(function () {
                    return a(this).button("widget")[0]
                }
                ).removeClass("ui-state-active").attr("aria-pressed", "false")
            }
            ) : (this.buttonElement.bind("mousedown" + this.eventNamespace, function () {
                return!g.disabled && (a(this).addClass("ui-state-active"), b = this, void d.document.one("mouseup", function () {
                    b = null
                }
                ))
            }
            ).bind("mouseup" + this.eventNamespace, function () {
                return!g.disabled && void a(this).removeClass("ui-state-active")
            }
            ).bind("keydown" + this.eventNamespace, function (b) {
                return!g.disabled && void(b.keyCode !== a.ui.keyCode.SPACE && b.keyCode !== a.ui.keyCode.ENTER || a(this).addClass("ui-state-active"))
            }
            ).bind("keyup" + this.eventNamespace + " blur" + this.eventNamespace, function () {
                a(this).removeClass("ui-state-active")
            }
            ), this.buttonElement.is("a") && this.buttonElement.keyup(function (b) {
                b.keyCode === a.ui.keyCode.SPACE && a(this).click()
            }
            )), this._setOption("disabled", g.disabled), this._resetButton()
        }
        , _determineButtonType: function () {
            var a, b, c;
            this.element.is("[type=checkbox]") ? this.type = "checkbox" : this.element.is("[type=radio]") ? this.type = "radio" : this.element.is("input") ? this.type = "input" : this.type = "button", "checkbox" === this.type || "radio" === this.type ? (a = this.element.parents().last(), b = "label[for='" + this.element.attr("id") + "']", this.buttonElement = a.find(b), this.buttonElement.length || (a = a.length ? a.siblings() : this.element.siblings(), this.buttonElement = a.filter(b), this.buttonElement.length || (this.buttonElement = a.find(b))), this.element.addClass("ui-helper-hidden-accessible"), c = this.element.is(":checked"), c && this.buttonElement.addClass("ui-state-active"), this.buttonElement.prop("aria-pressed", c)) : this.buttonElement = this.element
        }
        , widget: function () {
            return this.buttonElement
        }
        , _destroy: function () {
            this.element.removeClass("ui-helper-hidden-accessible"), this.buttonElement.removeClass(c + " ui-state-active " + d).removeAttr("role").removeAttr("aria-pressed").html(this.buttonElement.find(".ui-button-text").html()), this.hasTitle || this.buttonElement.removeAttr("title")
        }
        , _setOption: function (a, b) {
            return this._super(a, b), "disabled" === a ? (this.widget().toggleClass("ui-state-disabled", !!b), this.element.prop("disabled", !!b), void(b && ("checkbox" === this.type || "radio" === this.type ? this.buttonElement.removeClass("ui-state-focus") : this.buttonElement.removeClass("ui-state-focus ui-state-active")))) : void this._resetButton()
        }
        , refresh: function () {
            var b = this.element.is("input, button") ? this.element.is(":disabled") : this.element.hasClass("ui-button-disabled");
            b !== this.options.disabled && this._setOption("disabled", b), "radio" === this.type ? f(this.element[0]).each(function () {
                a(this).is(":checked") ? a(this).button("widget").addClass("ui-state-active").attr("aria-pressed", "true") : a(this).button("widget").removeClass("ui-state-active").attr("aria-pressed", "false")
            }
            ) : "checkbox" === this.type && (this.element.is(":checked") ? this.buttonElement.addClass("ui-state-active").attr("aria-pressed", "true") : this.buttonElement.removeClass("ui-state-active").attr("aria-pressed", "false"))
        }
        , _resetButton: function () {
            if ("input" === this.type)
                return void(this.options.label && this.element.val(this.options.label));
            var b = this.buttonElement.removeClass(d), c = a("<span></span>", this.document[0]).addClass("ui-button-text").html(this.options.label).appendTo(b.empty()).text(), e = this.options.icons, f = e.primary && e.secondary, g = [];
            e.primary || e.secondary ? (this.options.text && g.push("ui-button-text-icon" + (f ? "s" : e.primary ? "-primary" : "-secondary")), e.primary && b.prepend("<span class='ui-button-icon-primary ui-icon " + e.primary + "'></span>"), e.secondary && b.append("<span class='ui-button-icon-secondary ui-icon " + e.secondary + "'></span>"), this.options.text || (g.push(f ? "ui-button-icons-only" : "ui-button-icon-only"), this.hasTitle || b.attr("title", a.trim(c)))) : g.push("ui-button-text-only"), b.addClass(g.join(" "))
        }
    }), a.widget("ui.buttonset", {version: "1.11.4", options: {items: "button, input[type=button], input[type=submit], input[type=reset], input[type=checkbox], input[type=radio], a, :data(ui-button)"}
        , _create: function () {
            this.element.addClass("ui-buttonset")
        }
        , _init: function () {
            this.refresh()
        }
        , _setOption: function (a, b) {
            "disabled" === a && this.buttons.button("option", a, b), this._super(a, b)
        }
        , refresh: function () {
            var b = "rtl" === this.element.css("direction"), c = this.element.find(this.options.items), d = c.filter(":ui-button");
            c.not(":ui-button").button(), d.button("refresh"), this.buttons = c.map(function () {
                return a(this).button("widget")[0]
            }
            ).removeClass("ui-corner-all ui-corner-left ui-corner-right").filter(":first").addClass(b ? "ui-corner-right" : "ui-corner-left").end().filter(":last").addClass(b ? "ui-corner-left" : "ui-corner-right").end().end()
        }
        , _destroy: function () {
            this.element.removeClass("ui-buttonset"), this.buttons.map(function () {
                return a(this).button("widget")[0]
            }
            ).removeClass("ui-corner-left ui-corner-right").end().button("destroy")
        }
    }), a.ui.button
}
);
