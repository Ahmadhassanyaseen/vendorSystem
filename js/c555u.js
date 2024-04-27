!function (t, i, e, a) {
    "use strict";
    var n = "iptPluginUIFFront",
            s = {callback: null,
                themeCheckTimeout: 5e3,
                additionalThemes: [],
                waypoints: !0,
                applyUIOnly: !1,
                debug: !1, demoMode: !1};
    function l(i, e) {
        this.element = i, this.jElement = t(i),
                this.settings = t.extend({}, s, e),
                this._defaults = s,
                this._name = n,
                this.ui_theme_id = "ipt-uif-custom-none",
                this.ui_theme_slug = "none",
                //this.countryList = iptPluginUIFFront.countries, 
                this.init()
    }
    i.ipt_uif_front_captcha = function (i, e, a, n) {
        if (t(i).val() != t(i).data("sum"))
            return iptPluginUIFFront.L10n.validationEngine.requiredInFunction.alertText + t(i).data("sum")
    }, i.iptUIFSigVal = function (i, e, a, n) {
        if (-1 !== jQuery.inArray("required", e) && ("" === t(i).val() || "image/jsignature;base30," == t(i).val()))
            return iptPluginUIFFront.L10n.validationEngine.requiredSignature.alertText
    }, i.iptUIFSliderVal = function (i, e, a, n) {
        var s = t(i);
        if (1 == s.data("nomin"))
            if (s.hasClass("slider_range")) {
                if (s.val() == s.data("min") && s.siblings(".ipt_uif_slider_range_max").val() == s.data("min"))
                    return iptPluginUIFFront.L10n.validationEngine.noMinSlider.alertText
            } else if (s.val() == s.data("min"))
                return iptPluginUIFFront.L10n.validationEngine.noMinSlider.alertText
    }, i.iptUIFValidateCC = function (i, e, a, n) {
        var s, l, o, r = i.closest(".ipt_uif_card_holder");
        return i.hasClass("ipt_uif_cc_number") ? t.payment.validateCardNumber(i.val()) ? null !== (s = t.payment.cardType(i.val())) || iptPluginUIFFront.L10n.validationEngine.ccValidation.type : iptPluginUIFFront.L10n.validationEngine.ccValidation.number : i.hasClass("ipt_uif_cc_cvc") ? (s = r.find(".ipt_uif_cc_type").val(), !!t.payment.validateCardCVC(i.val(), s) || iptPluginUIFFront.L10n.validationEngine.ccValidation.cvc) : i.hasClass("ipt_uif_cc_expiry") ? (l = i.payment("cardExpiryVal"), !!t.payment.validateCardExpiry(l.month, l.year) || iptPluginUIFFront.L10n.validationEngine.ccValidation.expiry) : !i.hasClass("ipt_uif_cc_name") || (void 0 !== (o = i.val().split(" "))[1] && 0 !== o[1].length || iptPluginUIFFront.L10n.validationEngine.ccValidation.name)
    }, i.eFormInputMaskValidate = function (i, e, a, n) {
        return"function" != typeof t.fn.inputmask || (!!i.inputmask("isComplete") || iptPluginUIFFront.L10n.validationEngine.inputMask.alertText)
    }, l.prototype = {init: function () {
            var i, a, n = [], s = this.jElement;
            if (t("#ipt_uif_default_theme_link-css").length && (n[n.length] = t("#ipt_uif_default_theme_link-css").get(0)), !1 === t.support.opacity && (t("#ipt_uif_ie8_hack").length ? n[n.length] = t("#ipt_uif_ie8_hack").get(0) : (i = t('<link id="#ipt_uif_ie8_hack" rel="stylesheet" media="all" type="text/css" href="' + iptPluginUIFFront.location + "css/ie8.css?version=" + iptPluginUIFFront.version + '" />'), t("body").append(i), n[n.length] = i.get(0))), this.settings.additionalThemes.length)
                for (a = 0; a < this.settings.additionalThemes.length; a++)
                    "object" == typeof this.settings.additionalThemes[a] && "id"in this.settings.additionalThemes[a] && "src"in this.settings.additionalThemes[a] && (t("#" + this.settings.additionalThemes[a].id + "-css").length ? n[n.length] = t("#" + this.settings.additionalThemes[a].id + "-css").get(0) : (i = t('<link id="' + this.settings.additionalThemes[a].id + '-css" rel="stylesheet" media="all" type="text/css" href="' + this.settings.additionalThemes[a].src + '" />'), t("body").append(i), n[n.length] = i.get(0)));
            if (s.data("ui-theme") && s.data("ui-theme-id")) {
                var l = s.data("ui-theme"), o = s.data("ui-theme-id");
                this.ui_theme_id = "ipt-uif-custom-" + o, this.ui_theme_slug = o, s.addClass("ipt-uif-custom-" + o);
                var r, d, p = [];
                if ("object" == typeof l && l.length)
                    for (a = 0; a < l.length; a++)
                        (r = t(e).find("#" + o + "_" + a + "-css")).length ? (r.attr("href") !== l[a] && r.attr("href", l[a]), n[n.length] = r.get(0)) : p[p.length] = a;
                if (p.length)
                    for (a = 0; a < p.length; a++)
                        d = t('<link media="all" id="' + o + "_" + a + '-css" type="text/css" rel="stylesheet" href="' + l[p[a]] + '" />'), n[n.length] = d.get(0), t("body").append(d)
            } else {
                var c = s.closest("[data-ui-theme-id]");
                c.length && (this.ui_theme_slug = c.data("ui-theme-id"), this.ui_theme_id = "ipt-uif-custom-" + this.ui_theme_slug)
            }
            this.loadThemes(n)
        }, loadThemes: function (t) {
            if (t.length)
                if (this.settings.demoMode)
                    this.afterThemeLoaded();
                else {
                    var i, e, a, n = this;
                    "sheet"in t[0] ? (i = "sheet", e = "cssRules") : (i = "styleSheet", e = "rules");
                    n.afterThemeLoaded();
//                    var s = setInterval(function () {
//                        var l, o = !0;
//                        for (l = 0; l < t.length; l++) {
//                            if (!(void 0 !== t[l][i] && null !== t[l][i] && e in t[l][i])) {
//                                o = !1;
//                                break
//                            }
//                            try {
//                                if (!t[l][i][e].length) {
//                                    o = !1;
//                                    break
//                                }
//                            } catch (t) {
//                                o = !1
//                            }
//                        }
//                        o && (clearInterval(s), clearTimeout(a), n.afterThemeLoaded())
//                    }, 0);
//                    a = setTimeout(function () {
//                        clearInterval(s), clearTimeout(a), n.afterThemeLoaded()
//                    }, n.settings.themeCheckTimeout)
                }
            else
                this.afterThemeLoaded()
        }, afterThemeLoaded: function () {
            if (t.fn.button.noConflict && (t.fn.btn = t.fn.button.noConflict()), this.jElement.addClass("ipt_uif_common"), this.initLoader(), "undefined" != typeof blueimp && blueimp.Gallery && 0 === t("#blueimp-gallery").length && t("body").append('<div data-filter=":even" class="blueimp-gallery blueimp-gallery-controls" id="blueimp-gallery" style="display: none;"><div class="slides" style="width: 21600px;"></div><h3 class="title">Dummy.jpg</h3><a class="prev">‹</a><a class="next">›</a><a class="close">×</a><a class="play-pause"></a><ol class="indicator"></ol></div>'), !0 === this.settings.applyUIOnly)
                return '';
//                    this.initUIElements(), 
//                    this.initSDA(!0), 
//                    this.initConditionalLogic(), 
//                    this.triggerCompleted();
//                    void("function" == typeof this.settings.callback && this.settings.callback.apply(this.jElement, [this.ui_theme_id]));
            this.initUIElements(),
//                    this.initUIElementsDelegated(),
//                    this.initSDA(!1),
//                    this.initConditionalLogic(),
//                    this.triggerCompleted(),
                    "function" == typeof this.settings.callback && this.settings.callback.apply(this.jElement, [this.ui_theme_id])
        }, triggerCompleted: function () {
            this.jElement.trigger("completedUI.eform"), this.jElement.data("eFormUICompleted", !0)
        }, debugLog: function (t, i) {
            void 0 === i && (i = !1);
            try {
                console && (i ? console.warn(t) : console.log(t))
            } catch (t) {
            }
        }, initSDA: function (t) {
            var i = this;
            this.jElement.find(".ipt_uif_sda").each(function () {
                i.uiSDAinit.apply(this), i.uiSDAsort.apply(this)
            }), !0 !== t && (i.edSDAattachAdd(), i.edSDAattachDel())
        }, initLoader: function () {
            this.jElement.find(".ipt_uif_init_loader").hide(), this.jElement.find(".ipt_uif_hidden_init").show().css({opacity: 1, visibility: "visible"}), this.jElement.find(".ipt_uif_message").show(), setTimeout(function () {
                t(i).trigger("resize")
            }, 500)
        }, initConditionalLogic: function () {
            var i, e = {}, a = !0;
            this.conditionalInit = !0;
            try {
                e = JSON.parse(this.jElement.find(".ipt_uif_conditional_logic").val())
            } catch (t) {
                a = !1
            }
            if (a)
                if (this.settings.demoMode)
                    for (i in e.logics)
                        !1 === e.logics[i].status && (t("#" + i).addClass("demo-conditional-hidden"), t("#" + i).attr("aria-controls") && t("#" + t("#" + i).attr("aria-controls")).addClass("demo-conditional-hidden"));
                else {
                    for (i in e.logics)
                        !1 === e.logics[i].status && (t("#" + i).hide(), t("#" + i).attr("aria-controls") && t("#" + t("#" + i).attr("aria-controls")).hide());
                    !0 !== this.settings.applyUIOnly && this.edConditionalLogicAttachEvent(e), this.jElement.find(".ipt_uif_conditional").trigger("change"), this.jElement.find(".ipt_uif_text, .ipt_uif_textarea").typeWatch({callback: function () {
                            t(this).trigger("fsqm.conditional")
                        }, wait: 750, highlight: !1, captureLength: 1}), this.conditionalInit = !1
                }
        }, edConditionalLogicAttachEvent: function (i) {
            var e = this;
            e.jElement.on("change fsqm.conditional", function (a) {
                var n, s, l, o = t(a.target).closest(".ipt_uif_conditional").attr("id");
                if (o && void 0 !== i.indexes[o])
                    for (n in i.indexes[o]) {
                        if (s = i.logics[i.indexes[o][n]], !(l = t("#" + i.indexes[o][n])).length)
                            return;
                        e.validateLogic.apply(e, [i.base, s.logic, s.relation]) ? !0 === s.change ? e.conditionalShowElement.apply(l, [e]) : e.conditionalHideElement.apply(l, [e]) : !0 === s.status ? e.conditionalShowElement.apply(l, [e]) : e.conditionalHideElement.apply(l, [e])
                    }
            })
        }, conditionalShowElement: function (i) {
            var e = this;
            if (e.is(":visible"))
                return e.hasClass("iptUIFCHidden") && e.trigger("iptUIFCShow"), void e.stop(!0, !0).show().removeClass("iptUIFCHidden");
            e.hasClass("iptUIFCHidden") && e.find(".ipt-eform-hidden-field").length && e.find(".ipt-eform-hidden-field").each(function () {
                t(this).data("eformDefaultValue") && "" === t(this).val() && (t(this).val(t(this).data("eformDefaultValue")), t(this).trigger("change"))
            }), e.stop(!0, !0).removeClass("iptUIFCHidden").slideDown("fast").addClass("iptAnimated iptAppear"), !0 !== i.conditionalInit && i.conditionalRestoreDefault(e), setTimeout(function () {
                e.removeClass("iptAnimated iptAppear"), e.removeClass("iptFadeInLeft").css({opacity: ""}), i.refreshiFrames.apply(e), e.trigger("iptUIFCShow"), e.find("select").trigger("change.select2"), e.find(".ipt_uif_mathematical").length && e.trigger("fsqm.mathematicalReEvaluate")
            }, 200)
        }, conditionalHideElement: function () {
            var i, e, a, n, s, l, o, r, d, p = this;
            if (p.hasClass("iptUIFCHidden") || (i = p.find(".ipt_fsqm_payment_method_radio"), e = p.find(".ipt_fsqm_payment_method_radio .ipt_uif_radio").filter(":checked"), i.length && e.length && i.data("iptfsqmpp", e.val()), (a = p.find('input[type="checkbox"], input[type="radio"]')).length && a.prop("checked", !1).trigger("change"), (n = p.find('input[type="text"], textarea, input[type="password"], input[type="number"], input[type="email"], input[type="tel"]')).length && n.val("").trigger("change"), (s = p.find(".ipt_uif_slider")).length && (s.val("").trigger("change"), s.each(function () {
                var i = t(this).siblings("input");
                i.length && i.val("").trigger("change")
            })), (l = p.find("select")).length && l.each(function () {
                var i = t(this);
                i.val(i.prop("defaultSelected")), i.trigger("change")
            }), (o = p.find(".ipt_uif_jsignature_reset")).length && o.trigger("click"), (r = p.find(".ipt-eform-hidden-field")).length && r.each(function () {
                var i = t(this);
                "" !== i.val() && (i.data("eformDefaultValue", i.val()), i.val(""), i.trigger("change"))
            }), (d = p.find(".ipt-eform-trumbowyg")).length && (d.trumbowyg("empty"), p.find(".ipt-eform-guestpost").trigger("change"))), !p.is(":visible")) {
                var c = !1;
                return p.hasClass("iptUIFCHidden") || (c = !0), p.stop(!0, !0).hide().addClass("iptUIFCHidden"), void(c && p.trigger("iptUIFCHide"))
            }
            p.addClass("iptAnimated iptDisappear iptUIFCHidden").stop(!0, !0).fadeOut("fast"), p.attr("aria-controls") && t("#" + p.attr("aria-controls")).hide(), setTimeout(function () {
                p.removeClass("iptAnimated iptDisappear").hide(), p.trigger("iptUIFCHide"), p.find(".ipt_uif_mathematical").length && p.trigger("fsqm.mathematicalReEvaluate")
            }, 500)
        }, conditionalRestoreDefault: function (i) {
            i.find('input[type="text"], textarea, input[type="password"], input[type="number"], input[type="email"], input[type="tel"]').each(function () {
                var i = t(this);
                i.prop("defaultValue") && (i.val(i.prop("defaultValue")), i.trigger("change").trigger("updateTextFields.eform"), i.hasClass("ipt_uif_slider") && i.trigger("fsqm.slider"), i.hasClass("ipt_uif_slider_range_max") && i.trigger("fsqm.slider"))
            }), i.find('input[type="radio"], input[type="checkbox"]').each(function () {
                var i = t(this), e = i.prop("checked"), a = !1;
                1 == i.prop("defaultChecked") ? (i.prop("checked", !0), a = !0) : i.prop("checked", !1), e != a && i.trigger("change")
            }), i.find("select").each(function () {
                var i = t(this), e = i.find("option"), a = i.val(), n = !1;
                null == a && (a = ""), "object" != typeof a && (a = [a]), e.each(function () {
                    var i = t(this), e = i.val();
                    1 == i.prop("defaultSelected") ? (t.inArray(e, a) || (n = !0), i.prop("selected", !0)) : i.prop("selected", !1)
                }), n && i.trigger("change")
            }), setTimeout(function () {
                i.trigger("fsqm.mathematicalReEvaluate")
            }, 500)
        }, validateLogic: function (i, e) {
            var a, n, s, l, o, r, d, p, c, u, f, h, m, _, g, v, y, b, k, F = this, C = !1, x = [], P = [], T = [], E = {frown: 1, sad: 2, neutral: 3, happy: 4, excited: 5}, j = {like: 1, dislike: 0};
            for (a in e) {
                switch (n = e[a], l = (s = t("#ipt_fsqm_form_" + i + "_" + n.m_type + "_" + n.key)).prev(".ipt_fsqm_hf_type").val(), o = !1, r = null, d = !0, T[a] = {
                    }, T[a].x = n.m_type, T[a].k = n.key, T[a].has = n.check, T[a].value = n.value, T[a].rel = n.rel, T[a].which = n.operator, !0 === this.settings.debug && this.debugLog(T), l){case"radio":
                    case"p_radio":
                        r = [], s.find("input.ipt_uif_radio").filter(":checked").each(function () {
                            r[r.length] = jQuery.trim(t(this).next("label").text())
                        });
                        break;
                    case"checkbox":
                    case"p_checkbox":
                        r = [], s.find("input.ipt_uif_checkbox").filter(":checked").each(function () {
                            r[r.length] = jQuery.trim(t(this).next("label").text())
                        });
                        break;
                    case"select":
                    case"p_select":
                        r = [], s.find("select.ipt_uif_select option").filter(":selected").each(function () {
                            r[r.length] = jQuery.trim(t(this).text())
                        });
                        break;
                    case"thumbselect":
                        r = [], s.find("input.ipt_uif_radio, input.ipt_uif_checkbox").filter(":checked").each(function () {
                            r[r.length] = jQuery.trim(t(this).data("label"))
                        });
                        break;
                    case"pricing_table":
                        r = [], s.find("input.eform-pricing-table-radio").filter(":checked").each(function () {
                            r[r.length] = jQuery.trim(t(this).data("label"))
                        });
                        break;
                    case"slider":
                        r = F.intelParseFloat(s.find("input.ipt_uif_slider").val()), n.value = F.intelParseFloat(n.value);
                        break;
                    case"range":
                        r = [F.intelParseFloat(s.find("input.ipt_uif_slider.slider_range").val()), F.intelParseFloat(s.find("input.ipt_uif_slider.slider_range").siblings(".ipt_uif_slider_range_max").val())], n.value = F.intelParseFloat(n.value), "val" != n.check && (r = 0, y = s.find("input.ipt_uif_slider.slider_range"), b = s.find("input.ipt_uif_slider.slider_range").siblings(".ipt_uif_slider_range_max"), (k = F.intelParseFloat(y.attr("min"))) != F.intelParseFloat(y.val()) && k != F.intelParseFloat(b.val()) && (r = 1));
                        break;
                    case"spinners":
                        r = [], s.find("input.ipt_uif_uispinner").each(function () {
                            "" !== t(this).val() && (r[r.length] = F.intelParseFloat(t(this).val()))
                        }), n.value = F.intelParseFloat(n.value);
                        break;
                    case"grading":
                        r = [], s.find("input.ipt_uif_slider").each(function () {
                            "" !== t(this).val() && (r[r.length] = F.intelParseFloat(t(this).val()))
                        }), s.find("input.ipt_uif_slider.slider_range").each(function () {
                            "" !== t(this).val() && (r[r.length] = F.intelParseFloat(t(this).val())), t(this).siblings(".ipt_uif_slider_range_max").length && (r[r.length] = F.intelParseFloat(t(this).siblings(".ipt_uif_slider_range_max").val()))
                        }), n.value = F.intelParseFloat(n.value);
                        break;
                    case"starrating":
                    case"scalerating":
                        r = [], s.find(".ipt_uif_rating").each(function () {
                            t(this).find("input.ipt_uif_radio:checked").length && (r[r.length] = F.intelParseFloat(t(this).find("input.ipt_uif_radio:checked").val()))
                        }), n.value = F.intelParseFloat(n.value);
                        break;
                    case"matrix":
                        r = [], u = [], s.find(".ipt_uif_matrix thead th").each(function () {
                            u[u.length] = jQuery.trim(t(this).text())
                        }), s.find(".ipt_uif_checkbox,.ipt_uif_radio").filter(":checked").each(function () {
                            f = t(this).closest("tr").find("> *").index(t(this).closest("td")), "" === u[f] && void 0 === u[f] || (r[r.length] = u[f])
                        });
                        break;
                    case"toggle":
                    case"s_checkbox":
                        r = s.find('input[type="checkbox"]').is(":checked") ? "1" : "0", n.value = F.intelParseFloat(n.value);
                        break;
                    case"smileyrating":
                        void 0 !== E[c = s.find('input[type="radio"]:checked').val()] && (r = E[c]), n.value = F.intelParseFloat(n.value);
                        break;
                    case"likedislike":
                        void 0 !== j[c = s.find('input[type="radio"]:checked').val()] && (r = j[c]), n.value = F.intelParseFloat(n.value);
                        break;
                    case"matrix_dropdown":
                        r = [], s.find("select").each(function () {
                            "" !== (h = t(this).find("option").filter(":selected")).val() && (r[r.length] = h.text())
                        });
                        break;
                    case"feedback_small":
                    case"f_name":
                    case"l_name":
                    case"email":
                    case"phone":
                    case"p_name":
                    case"p_email":
                    case"p_phone":
                    case"textinput":
                    case"password":
                    case"keypad":
                        void 0 === (r = s.find("input.ipt_uif_text").val()) && "keypad" == l && (r = s.find("textarea").val()), F.isNumeric(r) && (r = F.intelParseFloat(r));
                        break;
                    case"feedback_large":
                    case"textarea":
                        r = s.find("textarea").val();
                        break;
                    case"upload":
                        r = s.find(".ipt_uif_uploader").data("totalUpload");
                        break;
                    case"mathematical":
                        r = F.intelParseFloat(s.find("input.ipt_uif_mathematical_input").val());
                        break;
                    case"address":
                        r = [], s.find(".ipt_uif_text").each(function () {
                            r[r.length] = t(this).val()
                        });
                        break;
                    case"datetime":
                        switch (r = s.find(".ipt_uif_text").val(), p = F.dates.compare(new Date(r), new Date(n.value)), !1 === t.support.opacity && (p = F.dates.compare(new Date(r.toString().replace(/-/g, "/")), new Date(n.value.toString().replace(/-/g, "/")))), n.operator) {
                            case"eq":
                                0 === p && (o = !0);
                                break;
                            case"neq":
                                0 !== p && (o = !0);
                                break;
                            case"gt":
                                1 === p && (o = !0);
                                break;
                            case"lt":
                                -1 === p && (o = !0)
                        }
                        d = !1;
                        break;
                    case"feedback_matrix":
                        r = [], s.find(".ipt_uif_text, .ipt_uif_textarea").each(function () {
                            "" !== (g = t.trim(t(this).val())) && (r[r.length] = g)
                        });
                        break;
                    case"gps":
                        r = [], s.find(".ipt_uif_text").length ? s.find(".ipt_uif_text").each(function () {
                            "" !== (g = t.trim(t(this).val())) && (r[r.length] = g)
                        }) : (v = s.find(".ipt_uif_locationpicker").data("gpsSettings")).values && (v.values.lat && (r[r.length] = v.values.lat), v.values.long && (r[r.length] = v.values.long), v.values.location_name && (r[r.length] = v.values.location_name));
                        break;
                    case"signature":
                        r = "0", "" !== (g = s.find(".ipt_uif_jsignature_input").val()) && "image/jsignature;base30," !== g && (r = "1"), n.value = F.intelParseFloat(n.value);
                        break;
                    case"payment":
                        r = s.find(".ipt_fsqm_payment_mathematical .ipt_uif_mathematical_input").val(), s.find(".ipt_uif_coupon").length && (r = s.find(".ipt_uif_coupon .ipt_uif_mathematical_input").val()), n.value = F.intelParseFloat(n.value);
                        break;
                    case"hidden":
                        r = s.find(".ipt-eform-hidden-field").val();
                        break;
                    case"guestblog":
                        (r = [])[r.length] = s.find(".ipt_uif_text").val(), r[r.length] = s.find(".ipt-eform-guestpost").val();
                        break;
                    case"repeatable":
                        r = s.find(".ipt_uif_sda_elem").length, n.value = F.intelParseFloat(n.value);
                        break;
                    default:
                        o = !1, d = !1
                }
                if (d) {
                    void 0 === r && (r = []);
                    var A = null, I = "number" == typeof n.value ? n.value : n.value.toString().toLowerCase();
                    if ("val" === n.check)
                        if ("object" == typeof r)
                            for (m in A = [], r)
                                A[A.length] = "number" == typeof r[m] ? r[m] : r[m].toString().toLowerCase();
                        else
                            A = "number" == typeof r ? r : r.toString().toLowerCase();
                    else
                        A = "number" == typeof r ? r : r.length, I = F.intelParseFloat(I);
                    var w = "object" == typeof A;
                    switch (n.operator) {
                        case"eq":
                            if (w)
                                for (m in A) {
                                    if ("" !== A[m] && A[m] == I) {
                                        o = !0;
                                        break
                                    }
                                    if ("" === A[m] && "" === I) {
                                        o = !0;
                                        break
                                    }
                                }
                            else
                                "" !== A && A == I ? o = !0 : "" === A && "" === I && (o = !0);
                            break;
                        case"neq":
                            if (w) {
                                for (m in o = !0, A)
                                    if ("" !== A[m] && A[m] == I) {
                                        o = !1;
                                        break
                                    }
                            } else
                                o = !0, "" !== A && A == I && (o = !1);
                            break;
                        case"gt":
                            if (w) {
                                for (m in A)
                                    if (A[m] > I) {
                                        o = !0;
                                        break
                                    }
                            } else
                                A > I && (o = !0);
                            break;
                        case"lt":
                            if (w) {
                                for (m in A)
                                    if (A[m] < I) {
                                        o = !0;
                                        break
                                    }
                            } else
                                A < I && (o = !0);
                            break;
                        case"ct":
                            if (w)
                                if ("range" == l)
                                    o = !1, I >= A[0] && I <= A[1] && (o = !0);
                                else
                                    for (m in A) {
                                        try {
                                            A[m] = A[m].toString()
                                        } catch (t) {
                                            A[m] = A[m] + ""
                                        }
                                        if ("" !== A[m] && -1 !== A[m].indexOf(I)) {
                                            o = !0;
                                            break
                                        }
                                    }
                            else {
                                try {
                                    A = A.toString()
                                } catch (t) {
                                    A += ""
                                }
                                "" !== A && -1 !== A.indexOf(I) && (o = !0)
                            }
                            break;
                        case"dct":
                            if (w)
                                if ("range" == l)
                                    o = !1, (I < A[0] || I > A[1]) && (o = !0);
                                else
                                    for (m in o = !0, A) {
                                        try {
                                            A[m] = A[m].toString()
                                        } catch (t) {
                                            A[m] = A[m] + ""
                                        }
                                        if ("" !== A[m] && -1 !== A[m].indexOf(I)) {
                                            o = !1;
                                            break
                                        }
                                    }
                            else {
                                o = !0;
                                try {
                                    A = A.toString()
                                } catch (t) {
                                    A += ""
                                }
                                "" !== A && -1 !== A.indexOf(I) && (o = !1)
                            }
                            break;
                        case"sw":
                            if (_ = new RegExp("^" + I, "m"), w) {
                                for (m in A)
                                    if (_.test(A[m])) {
                                        o = !0;
                                        break
                                    }
                            } else
                                _.test(A) && (o = !0);
                            break;
                        case"ew":
                            if (_ = new RegExp(I + "$", "m"), w) {
                                for (m in A)
                                    if (_.test(A[m])) {
                                        o = !0;
                                        break
                                    }
                            } else
                                _.test(A) && (o = !0)
                    }
                }
                x[a] = o, P[a] = n.rel
            }
            var U, L = null, S = null, D = [], N = 0;
            for (U in x) {
                if (null === L)
                    L = x[U];
                else
                    switch (S) {
                        case"and":
                            L = L && x[U];
                            break;
                        case"or":
                            N++, L = x[U]
                    }
                S = P[U], D[N] = L
            }
            for (m in C = null, D)
                C = null === C ? D[m] : C || D[m];
            return C
        }, initUIElements: function () {
            this.uiCheckboxToggler(), this.uiApplySlider(), this.uiApplyProgressBar(), this.uiApplyDateTimePicker(), this.uiApplyConditionalInput(), this.uiApplyConditionalSelect(), this.uiApplyImageSlider(), this.uiApplyRating(), this.uiApplySmileyRating(), this.uiApplyLikeDislikeRating(), this.uiApplyKeypad(), this.uiApplyAutoComplete(), this.uiApplyButtons(), this.uiApplyValidation(), this.uiApplyCollapsible(), this.uiApplySortable(), this.uiApplyUploader();
            try {
                this.uiApplyLocationPicker()
            } catch (t) {
                this.debugLog(t, !0)
            }
            this.uiApplyTrumbowyg(), this.uiApplyTabs(), this.uiApplyWayPoints(), this.uiApplyTooltip(), this.uiApplyjSignature(), this.uiApplyCards(), this.uiApplyTimeCircles(), this.uiApplyMathematicalEvaluator(), this.uiApplySelectMenu(), this.uiApplyCountry(), this.uiApplyEstimationSlider(), this.uiApplyInputMask()
        }, uiApplyInputMask: function () {
            "function" == typeof t.fn.inputmask && this.jElement.find(".eform-inputmask").inputmask()
        }, uiApplyEstimationSlider: function () {
            var i = this;
            this.jElement.find(".eform-ui-estimator").each(function () {
                var e = t(this);
                i._positionEstimation(e)
            })
        }, uiApplyCountry: function () {
            var i, e = this;
            for (i in this.countryAutoComplete = [], this.countryList)
                this.countryAutoComplete[this.countryAutoComplete.length] = this.countryList[i].label;
            this.jElement.find(".ipt-eform-address-country").each(function () {
                var i = t(this).find(".ipt_uif_autocomplete"), a = t(this).closest(".ipt_fsqm_container_address").find(".ipt-eform-address-province .ipt_uif_autocomplete");
                i.autocomplete("option", "source", e.countryAutoComplete), "" != i.val() && a.length && e._updateProvince(i)
            }), this.jElement.find(".ipt-eform-address-province .ipt_uif_autocomplete").each(function () {
                var i = t(this);
                i.data("presetCountry") && "" != i.data("presetCountry") && e._updateProvince(i, !0)
            })
        }, uiApplySelectMenu: function () {
            if (void 0 !== t.fn.select2) {
                this.jElement.hasClass("eform-override-element-boxy") && t("select.ipt_uif_select").attr("data-theme", "eform-material eform-select2-boxy"), t("select.ipt_uif_select").select2()
            }
        }, uiApplyMathematicalEvaluator: function () {
            if ("undefined" != typeof exprEval) {
                var t = this;
                this.jElement.data("iptFSQMMathVarToElem") || this.jElement.data("iptFSQMMathVarToElem", {}), this.jElement.find(".ipt_uif_mathematical_input").each(function () {
                    try {
                        t.evaluateMathematicalFormula.apply(this, [t])
                    } catch (i) {
                        t.debugLog(i, !0)
                    }
                })
            }
        }, uiApplyTimeCircles: function () {
            void 0 !== t.fn.TimeCircles && this.jElement.find(".ipt_uif_circle_timer").each(function () {
                var i, e = t(this).data("coptions"), a = ["Days", "Hours", "Minutes", "Seconds"];
                for (i in"object" != typeof e && (e = {}), void 0 === e.time && (e.time = {}), a)
                    void 0 === e.time[a[i]] && (e.time[a[i]] = {}), e.time[a[i]].text = iptPluginUIFFront.L10n.timer[a[i]];
                t(this).TimeCircles(e)
            })
        }, uiApplyCards: function () {
            void 0 !== t.fn.payment && this.jElement.find(".ipt_uif_card_holder").each(function () {
                var i = t(this), e = i.find(".ipt_uif_cc_number"), a = i.find(".ipt_uif_cc_expiry"), n = i.find(".ipt_uif_cc_cvc"), s = i.find(".ipt_uif_cc_type"), l = {cvc: !1, expiry: !1};
                e.payment("formatCardNumber").on("input", t.debounce(100, function () {
                    var i = t(this), e = t.payment.cardType(i.val());
                    null !== e ? s.val(e) : s.val(""), t.payment.validateCardNumber(i.val()) && a.length && a.focus()
                })), n.payment("formatCardCVC").on("keyup", t.debounce(100, function (i) {
                    var e, n = t(this);
                    8 == i.keyCode && "" == n.val() && l.cvc && a.length ? (a.focus(), "" != (e = a.val()) && a.val(e.slice(0, -1))) : "" == n.val() && 8 == i.keyCode ? l.cvc = !0 : l.cvc = !1
                })), a.payment("formatCardExpiry").on("input", t.debounce(150, function () {
                    var i = t(this).payment("cardExpiryVal");
                    t.payment.validateCardExpiry(i.month, i.year) && n.length && n.focus()
                })).on("keyup", t.debounce(100, function (i) {
                    var a, n = t(this);
                    8 == i.keyCode && "" == n.val() && l.expiry && e.length ? (e.focus(), "" != (a = e.val()) && e.val(a.slice(0, -1))) : "" == n.val() && 8 == i.keyCode ? l.expiry = !0 : l.expiry = !1
                }))
            })
        }, uiApplyjSignature: function () {
            void 0 !== t.fn.jSignature && setTimeout(t.proxy(function () {
                this.jElement.find(".ipt_uif_jsignature_pad").filter(":visible").each(function () {
                    var i = t(this), e = i.siblings(".ipt_uif_jsignature_input").val();
                    i.data("eFormjSignatureUpdating", !0), i.jSignature({lineWidth: 2, UndoButton: !0, signatureLine: !0}), "" !== e && "image/jsignature;base30," != e && i.jSignature("setData", e, "base30"), i.data("eFormjSignatureUpdating", !1)
                })
            }, this), 500)
        }, uiApplyTooltip: function () {
            this.jElement.find(".ipt_uif_tooltip").tooltipster({theme: "tooltipster-shadow", animation: "grow"}), this.jElement.find(".ipt_uif_qtooltip").tooltipster({theme: "tooltipster-shadow", animation: "grow", side: "left", contentAsHTML: !0, interactive: !0})
        }, uiApplyWayPoints: function () {
//            if (!0 === this.settings.waypoints && !this.settings.demoMode) {
//                var i = this.jElement.find(".ipt_uif_conditional").filter(":visible").css({opacity: 0}).removeClass("iptAnimated iptFadeInLeft");
//                setTimeout(function () {
//                    i.waypoint({handler: function (i) {
//                            var e;
//                            "function" == typeof this.destroy ? ((e = t(this.element)).css({opacity: ""}), e.is(":visible") && (e.addClass("iptAnimated iptFadeInLeft"), setTimeout(function () {
//                                e.removeClass("iptAnimated iptFadeInLeft")
//                            }, 500)), this.destroy()) : ((e = t(this)).css({opacity: ""}), e.is(":visible") && (e.addClass("iptAnimated iptFadeInLeft"), setTimeout(function () {
//                                e.removeClass("iptAnimated iptFadeInLeft")
//                            }, 500)), e.waypoint("destroy"))
//                        }, offset: "98%"})
//                }, 100)
//            }
        }, uiApplyLocationPicker: function () {
            void 0 !== t.fn.locationpicker && this.jElement.find(".ipt_uif_locationpicker").each(function () {
                var e = t(this), a = e.data("gpsSettings"), n = e.find(".locationpicker-maps-control"), s = e.find(".locationpicker-maps-locating"), l = e.find(".location-maps-error");
                if (!1 === a.showUI)
                    t.isNumeric(a.values.lat) && t.isNumeric(a.values.long) ? (n.locationpicker({location: {latitude: a.values.lat, longitude: a.values.long}, radius: a.radius, zoom: a.zoom}), setTimeout(function () {
                        e.trigger("fsqm.conditional")
                    }, 200), e.closest(".ipt_uif_conditional").on("iptUIFCShow", function () {
                        n.locationpicker("autosize")
                    }), e.closest(".ipt_fsqm_main_tab").on("tabsactivate", function () {
                        n.locationpicker("autosize")
                    }), t(i).on("resize", function () {
                        n.locationpicker("autosize")
                    }), t(i).on("fsqm.rlp", function () {
                        n.locationpicker("autosize")
                    })) : n.html(a.nolocation);
                else {
                    var o = function () {
                        s.stop(!0, !0).fadeIn("fast"), l.hide(), t.geolocation.get({success: function (t) {
                                var i = t.coords.accuracy;
                                i || (i = a.radius), n.locationpicker("location", {latitude: t.coords.latitude, longitude: t.coords.longitude, radius: i}), s.hide(), l.hide(), setTimeout(function () {
                                    e.trigger("locationPicker.eform"), e.trigger("fsqm.conditional")
                                }, 200)
                            }, fail: function (t) {
                                s.stop(!0, !0).hide(), l.stop(!0, !0).fadeIn("fast").delay(4e3).fadeOut("fast"), setTimeout(function () {
                                    e.trigger("locationPicker.eform"), e.trigger("fsqm.conditional")
                                }, 200)
                            }, options: {enableHighAccuracy: !0, timeout: 3e4, maximumAge: 0}})
                    };
                    n.locationpicker({location: {latitude: a.values.lat, longitude: a.values.long}, locationName: a.values.location_name, radius: a.radius, zoom: a.zoom, scrollwheel: a.scrollwheel, inputBinding: {latitudeInput: t("#" + a.ids.latitudeInput), longitudeInput: t("#" + a.ids.longitudeInput), locationNameInput: t("#" + a.ids.locationNameInput)}, enableAutocomplete: !0, oninitialized: function (i) {
                            e.trigger("locationPicker.eform"), t.isNumeric(a.values.lat) && t.isNumeric(a.values.long) || o()
                        }, onchanged: function () {
                            setTimeout(function () {
                                e.trigger("locationPicker.eform"), e.trigger("fsqm.conditional")
                            }, 200)
                        }}), e.find(".location-update").length && e.find(".location-update").on("click", function (t) {
                        t.preventDefault(), o()
                    })
                }
            })
        }, uiApplyUploader: function () {
            void 0 !== t.fn.fileupload && this.jElement.find(".ipt_uif_uploader").each(function () {
                var i = t(this), e = i.data("settings"), a = i.data("configuration"), n = i.data("formdata"), s = i.find(".ipt_uif_uploader_handle"), l = i.find(".fileinput-dragdrop"), o = new RegExp("(.|/)(" + e.accept_file_types.split(",").join("|") + ")$", "i");
                i.fileupload({url: iptPluginUIFFront.ajaxurl + a.upload_url, dropZone: l, fileInput: s, formData: n, acceptFileTypes: o, maxFileSize: parseInt(e.max_file_size, 10), minFileSize: parseInt(e.min_file_size, 10), maxNumberOfFiles: parseInt(e.max_number_of_files, 10), uploadTemplateId: a.id + "_tmpl_upload", downloadTemplateId: a.id + "_tmpl_download", previewMaxHeight: 100, previewMaxWidth: 150, autoUpload: !0 === e.auto_upload, messages: iptPluginUIFFront.L10n.uploader.messages}), i.data("activeUpload", 0), i.data("totalUpload", 0), i.on("fileuploadsend", function (t, e) {
                    var a = i.data("activeUpload");
                    a++, i.data("activeUpload", a)
                }), i.on("fileuploadalways", function (t, e) {
                    var a = i.data("activeUpload");
                    a--, i.data("activeUpload", a), i.trigger("change")
                }), i.on("fileuploaddone", function (t, e) {
                    var a = i.data("totalUpload");
                    void 0 === e._response.result.files[0].error && a++, i.data("totalUpload", a)
                }), i.on("fileuploaddestroyed", function (t, e) {
                    var a = i.data("totalUpload");
                    "" !== e.url && a--, i.data("totalUpload", a), i.trigger("change")
                }), !0 === a.do_download && (i.addClass("fileupload-processing"), t.ajax({url: iptPluginUIFFront.ajaxurl + a.download_url, data: n, context: i.get(0)}).always(function () {
                    t(this).removeClass("fileupload-processing")
                }).done(function (i) {
                    void 0 !== i.files.length && t(this).data("totalUpload", i.files.length), t(this).fileupload("option", "done").call(this, t.Event("done"), {result: i})
                }))
            })
        }, uiApplySortable: function () {
            this.jElement.find(".ipt_uif_sorting").sortable({handle: ".ipt_uif_sorting_handle", items: "> .ipt_uif_sortme", helper: "clone", appendTo: this.jElement, containment: "parent", placeholder: "ipt_uif_sortme_placeholder", forcePlaceholderSize: !0})
        }, uiApplyValidation: function () {
            this.jElement.find("form.ipt_uif_validate_form").validationEngine({promptPosition: "topLeft", bindOnSubmit: !1})
        }, uiApplyButtons: function () {
            this.jElement.find(".ipt_uif_button, .ipt_uif_ul_menu > li > a").button()
        }, uiApplyAutoComplete: function () {
            this.jElement.find(".ipt_uif_autocomplete").each(function () {
                t(this).autocomplete({source: t(this).data("autocomplete"), appendTo: t(this).parents(".ipt_uif_front")})
            })
        }, uiApplyKeypad: function () {
            var i = this;
            this.jElement.find(".ipt_uif_keypad").each(function () {
                var e = t(this).data("settings");
                t(this).keyboard({layout: e.layout, usePreview: !1, autoAccept: !0, appendLocally: !1, appendTo: i.jElement})
            })
        }, uiApplyRating: function () {
            this.jElement.find(".ipt_uif_rating input:checked").each(function () {
                t(this).addClass("active").prevAll("input").addClass("active")
            })
        }, uiApplySmileyRating: function () {
            this.jElement.find(".ipt_uif_rating_smiley").each(function () {
                t(this).find("input.ipt_uif_smiley_rating_radio:checked").length ? t(this).addClass("ipt_uif_smiley_feedback_active") : t(this).removeClass("ipt_uif_smiley_feedback_active")
            })
        }, uiApplyLikeDislikeRating: function () {
            this.jElement.find(".ipt_uif_rating_likedislike").each(function () {
                t(this).find("input.ipt_uif_likedislike_rating_radio:checked").length ? t(this).addClass("ipt_uif_likedislike_feedback_active") : t(this).removeClass("ipt_uif_likedislike_feedback_active")
            })
        }, uiApplyImageSlider: function () {
            this.jElement.find(".ipt_uif_image_slider_wrap").each(function () {
                var i = t(this), e = i.data("settings"), a = t('<a class=""></a>'), n = i.find(".ipt_uif_image_slider"), s = e.on_play, l = e.on_pause;
                n.nivoSlider({effect: e.animation, animSpeed: 1e3 * e.transition, pauseTime: 1e3 * e.duration, pauseOnHover: !1, manualAdvance: !e.autoslide, controlNav: !0, prevText: "", nextText: ""}), n.find("a.nivo-prevNav").after(a), a.on("click", function (i) {
                    i.preventDefault();
                    var e = n.data("nivoslider");
                    t(this).hasClass("ipt_uif_image_slider_sliding") ? (e.stop(), t(this).removeClass("ipt_uif_image_slider_sliding"), t(this).removeClass(s), t(this).addClass(l)) : (e.start(), t(this).addClass("ipt_uif_image_slider_sliding"), t(this).removeClass(l), t(this).addClass(s))
                }), !0 === e.autoslide ? (a.addClass("ipt_uif_image_slider_sliding"), a.removeClass(l), a.addClass(s)) : (a.removeClass("ipt_uif_image_slider_sliding"), a.removeClass(s), a.addClass(l))
            })
        }, uiCheckboxToggler: function () {
            var i = this.jElement;
            i.find(".ipt_uif_checkbox_toggler").each(function () {
                var e = t(this);
                e.is(":checked") && t(e.data("selector")).prop("checked", !0), i.on("change", e.data("selector"), function () {
                    e.prop("checked", !1)
                })
            })
        }, uiApplySpinner: function () {
            this.jElement.find(".ipt_uif_uispinner").spinner()
        }, uiApplySlider: function () {
            if (void 0 !== t.fn.slider) {
                this.jElement.find(".ipt_uif_slider").each(function () {
                    var i, e, a, n, s, l, o, r, d, p, c, u, f, h = t(this), m = null;
                    i = parseFloat(t(this).data("step")), isNaN(i) && (i = 1), e = parseFloat(t(this).data("min")), isNaN(e) && (e = 1), a = parseFloat(t(this).data("max")), isNaN(a) && (a = null), n = parseFloat(t(this).val()), isNaN(n) && (n = e), s = !!t(this).hasClass("slider_range"), c = 1 == t(this).data("floats"), u = 1 == t(this).data("vertical"), f = parseInt(t(this).data("height")), (isNaN(f) || f <= 0) && (f = 300), l = {min: e, max: a, step: i, range: s}, u && (l.orientation = "vertical"), s && (m = h.next("input"), o = parseFloat(m.val()), isNaN(o) && (o = e)), r = h.siblings("div.ipt_uif_slider_count"), (d = t("<div />")).addClass(s ? "ipt_uif_slider_range" : "ipt_uif_slider_single").addClass("ipt_uif_slider_div"), (p = s ? m.next("div.ipt_uif_slider_range") : h.next("div.ipt_uif_slider_range")).length && p.remove(), h.after(d), s ? (l.values = [n, o], l.range = !0) : l.value = n, r.length && (s ? (r.find("span.ipt_uif_slider_count_min").text(n), r.find("span.ipt_uif_slider_count_max").text(o)) : r.find("span").text(n)), u && d.height(f);
                    var _ = h.data("labels"), g = d.slider(l);
                    _.labels.length && g.slider("pips", h.data("labels")), c && g.slider("float")
                })
            }
        }, uiApplyProgressBar: function () {
            this.jElement.find(".ipt_uif_progress_bar").each(function () {
                var i = t(this), e = i.data("start") ? i.data("start") : 0, a = i.data("decimals"), n = i.find(".ipt_uif_progress_value span").addClass("code");
                n.html(e + "%"), n.data("iptPBVal", e);
                i.progressbar({value: e, change: function (i, e) {
                        var s = t(this).progressbar("option", "value"), l = new CountUp(n.get(0), n.data("iptPBVal"), s, a, 1, {useEasing: !0, useGrouping: !1, separator: "", decimal: ".", prefix: "", suffix: "%"});
                        n.data("iptPBCU") && n.data("iptPBCU").reset(), l.start(), n.data("iptPBVal", s), n.data("iptPBCU", l)
                    }})
            })
        }, uiApplyDateTimePicker: function () {
            var i = this;
            this.jElement.find(".ipt_uif_datepicker").each(function () {
                var e = t(this), a = e.data("year_range");
                a || (a = 50), e.datepicker({dateFormat: t(this).data("dateformat"), duration: 0, beforeShow: function () {
                        var a, n, s = "", l = null, o = null;
                        e.data("future") && ((a = e.data("future").toLowerCase()).match(/(\d+)-(\d+)-(\d+)/) ? l = new Date(a) : (l = null, "" !== (s = t("#" + e.data("future")).val()) && (l = new Date(s))), null !== l && (l.setDate(l.getDate() + 1), e.datepicker("option", "minDate", l))), e.data("past") && ((n = e.data("past").toLowerCase()).match(/(\d+)-(\d+)-(\d+)/) ? o = new Date(n) : "" != (s = t("#" + e.data("past")).val()) && (o = new Date(s)), null !== o && (o.setDate(o.getDate() - 1), e.datepicker("option", "maxDate", o))), t("body").addClass(i.ui_theme_slug), e.trigger("datepickerOpen.eform")
                    }, onClose: function () {
                        t("body").removeClass(i.ui_theme_slug), e.trigger("datepickerClose.eform");
                        try {
                            e.validationEngine("validate")
                        } catch (t) {
                        }
                        "" == e.val() ? e.addClass("is-empty") : e.removeClass("is-empty")
                    }, showButtonPanel: !0, closeText: iptPluginUIFDTPL10n.closeText, currentText: iptPluginUIFDTPL10n.currentText, monthNames: iptPluginUIFDTPL10n.monthNames, monthNamesShort: iptPluginUIFDTPL10n.monthNamesShort, dayNames: iptPluginUIFDTPL10n.dayNames, dayNamesShort: iptPluginUIFDTPL10n.dayNamesShort, dayNamesMin: iptPluginUIFDTPL10n.dayNamesMin, firstDay: iptPluginUIFDTPL10n.firstDay, isRTL: iptPluginUIFDTPL10n.isRTL, timezoneText: iptPluginUIFDTPL10n.timezoneText, changeMonth: !0, changeYear: !0, yearRange: "c-" + a + ":c+" + a, appendTo: i.jElement})
            }), this.jElement.find(".ipt_uif_datetimepicker").each(function () {
                var e = t(this), a = e.data("year_range");
                a || (a = 50), t(this).datetimepicker({dateFormat: t(this).data("dateformat"), duration: 0, timeFormat: t(this).data("timeformat"), beforeShow: function () {
                        t("body").addClass(i.ui_theme_slug), e.trigger("datepickerOpen.eform")
                    }, onClose: function () {
                        t("body").removeClass(i.ui_theme_slug), e.trigger("datepickerClose.eform");
                        try {
                            e.validationEngine("validate")
                        } catch (t) {
                        }
                        "" == e.val() ? e.addClass("is-empty") : e.removeClass("is-empty")
                    }, showButtonPanel: !0, closeText: iptPluginUIFDTPL10n.closeText, currentText: iptPluginUIFDTPL10n.tcurrentText, monthNames: iptPluginUIFDTPL10n.monthNames, monthNamesShort: iptPluginUIFDTPL10n.monthNamesShort, dayNames: iptPluginUIFDTPL10n.dayNames, dayNamesShort: iptPluginUIFDTPL10n.dayNamesShort, dayNamesMin: iptPluginUIFDTPL10n.dayNamesMin, firstDay: iptPluginUIFDTPL10n.firstDay, isRTL: iptPluginUIFDTPL10n.isRTL, amNames: iptPluginUIFDTPL10n.amNames, pmNames: iptPluginUIFDTPL10n.pmNames, timeSuffix: iptPluginUIFDTPL10n.timeSuffix, timeOnlyTitle: iptPluginUIFDTPL10n.timeOnlyTitle, timeText: iptPluginUIFDTPL10n.timeText, hourText: iptPluginUIFDTPL10n.hourText, minuteText: iptPluginUIFDTPL10n.minuteText, secondText: iptPluginUIFDTPL10n.secondText, millisecText: iptPluginUIFDTPL10n.millisecText, microsecText: iptPluginUIFDTPL10n.microsecText, timezoneText: iptPluginUIFDTPL10n.timezoneText, changeMonth: !0, changeYear: !0, yearRange: "c-" + a + ":c+" + a, appendTo: i.jElement})
            }), this.jElement.find(".ipt_uif_timepicker").each(function () {
                var e = t(this);
                t(this).timepicker({timeFormat: t(this).data("timeformat"), duration: 0, beforeShow: function () {
                        t("body").addClass(i.ui_theme_slug), e.trigger("datepickerOpen.eform")
                    }, onClose: function () {
                        t("body").removeClass(i.ui_theme_slug), e.trigger("datepickerClose.eform");
                        try {
                            e.validationEngine("validate")
                        } catch (t) {
                        }
                        "" == e.val() ? e.addClass("is-empty") : e.removeClass("is-empty")
                    }, showButtonPanel: !0, closeText: iptPluginUIFDTPL10n.closeText, currentText: iptPluginUIFDTPL10n.tcurrentText, isRTL: iptPluginUIFDTPL10n.isRTL, amNames: iptPluginUIFDTPL10n.amNames, pmNames: iptPluginUIFDTPL10n.pmNames, timeSuffix: iptPluginUIFDTPL10n.timeSuffix, timeOnlyTitle: iptPluginUIFDTPL10n.timeOnlyTitle, timeText: iptPluginUIFDTPL10n.timeText, hourText: iptPluginUIFDTPL10n.hourText, minuteText: iptPluginUIFDTPL10n.minuteText, secondText: iptPluginUIFDTPL10n.secondText, millisecText: iptPluginUIFDTPL10n.millisecText, microsecText: iptPluginUIFDTPL10n.microsecText, timezoneText: iptPluginUIFDTPL10n.timezoneText, appendTo: i.jElement})
            })
        }, uiApplyConditionalInput: function () {
            this.jElement.find(".ipt_uif_conditional_input").each(function () {
                var i, e, a = [], n = [];
                for (t(this).find("input").each(function(){i = "string" == typeof (i = t(this).data("condid"))?i.split(","):[], t(this).is(":checked")?a.push.apply(a, i):n.push.apply(n, i)}), e = 0; e < n.length; e++)
                    t("#" + n[e]).stop(!0, !0).hide();
                for (e = 0; e < a.length; e++)
                    t("#" + a[e]).stop(!0, !0).show()
            })
        }, uiApplyConditionalSelect: function () {
//            this.jElement.find(".ipt_uif_conditional_select").each(function () {
//                var i, e, a = [], n = [];
//                for (t(this).find("select").find("option").each(function(){i = "string" == typeof (i = t(this).data("condid"))?i.split(","):[], t(this).is(":selected")?a.push.apply(a, i):n.push.apply(n, i)}), e = 0; e < n.length; e++)
//                    t("#" + n[e]).stop(!0, !0).hide();
//                for (e = 0; e < a.length; e++)
//                    t("#" + a[e]).stop(!0, !0).show()
//            })
        }, uiApplyCollapsible: function () {
            var i = this;
            this.jElement.find(".ipt_uif_collapsible").each(function () {
                var e = !1, a = t(this), n = a.find("> .ipt_uif_container_inner");
                !0 !== a.data("opened") && 1 !== a.data("opened") || (e = !0), e ? (n.show(), i.refreshiFrames(n), a.addClass("ipt_uif_collapsible_open")) : (n.hide(), a.removeClass("ipt_uif_collapsible_open")), t(this).trigger("iptUICollapsible")
            })
        }, uiApplyTrumbowyg: function () {
            "function" == typeof jQuery.fn.trumbowyg && this.jElement.find(".ipt-eform-trumbowyg").each(function () {
                var i = t(this).data("efTrum");
                "object" != typeof i && (i = null), t(this).trumbowyg(i)
            })
        }, uiApplyTabs: function () {
            var i = this;
            this.jElement.find(".ipt_uif_tabs").each(function () {
                var e = {collapsible: !!t(this).data("collapsible"), show: 200, create: function (e, a) {
                        if (!i.settings.demoMode) {
                            !0 === i.settings.waypoints && a.panel.data("iptWaypoints", !0);
                            for (var n = 0, s = a.tab.parent(".ui-tabs-nav").find("> li"); s.eq(n).hasClass("iptUIFCHidden"); )
                                if (++n >= s.length) {
                                    n = 0;
                                    break
                                }
                            t(this).tabs("option", "active", n)
                        }
                    }, beforeActivate: function (t, e) {
                        e.newPanel.data("iptWaypoints") || !0 !== i.settings.waypoints || e.newPanel.find(".ipt_uif_conditional").css({opacity: 0}).removeClass("iptAnimated iptFadeInLeft")
                    }, activate: function (e, a) {
                        (i.refreshiFrames.apply(a.oldPanel), i.refreshiFrames.apply(a.newPanel), a.newPanel.data("iptWaypoints") || !0 !== i.settings.waypoints) || (a.newPanel.find(".ipt_uif_conditional").waypoint({handler: function (i) {
                                var e;
                                "function" == typeof this.destroy ? ((e = t(this.element)).css({opacity: ""}).addClass("iptAnimated iptFadeInLeft"), setTimeout(function () {
                                    e.removeClass("iptAnimated iptFadeInLeft")
                                }, 500), this.destroy()):((e = t(this)).css({opacity : ""}).addClass("iptAnimated iptFadeInLeft"), setTimeout(function () {
                                    e.removeClass("iptAnimated iptFadeInLeft")
                                }, 500), e.waypoint("destroy"))
                            }, offset: "98%"}), a.newPanel.data("iptWaypoints", !0))
                    }};
                i.settings.demoMode && void 0 !== t(this).data("demoActive") && (e.active = t(this).data("demoActive")), t(this).tabs(e), t(this).hasClass("vertical") && (t(this).addClass("ui-tabs-vertical ui-helper-clearfix"), t(this).find("> ul > li").removeClass("ui-corner-top").addClass("ui-corner-left"))
            })
        }, uiSDAinit: function () {
            var i = t(this), e = i.find("> .ipt_uif_sda_foot button.ipt_uif_sda_button"), a = {sort: 1 == i.data("draggable"), add: 1 == i.data("addable"), del: 1 == i.data("addable"), count: e.length && e.data("count") ? e.data("count") : 0, key: e.length && e.data("key") ? e.data("key") : "__KEY__", max: i.data("max"), min: i.data("min")};
            i.data("iptSDAdata", a);
            var n = i.find("> .ipt_uif_sda_body > .ipt_uif_sda_elem").length;
            "" !== a.max && a.max > 0 && n >= a.max && e.hide(), "" !== a.min && a.min > 0 && (n <= a.min ? i.addClass("eform-sda-reached-min") : i.removeClass("eform-sda-reached-min")), 0 == n ? i.addClass("ipt-uif-sda-empty") : i.removeClass("ipt-uif-sda-empty")
        }, uiSDAsort: function () {
            var i = t(this);
            !0 === i.data("iptSDAdata").sort && i.find("> .ipt_uif_sda_body").sortable({items: "div.ipt_uif_sda_elem", placeholder: "ipt_uif_sda_highlight", handle: "div.ipt_uif_sda_drag", distance: 5, axis: "y", start: function (t, i) {
                    i.placeholder.height(i.item.outerHeight())
                }, helper: "original", cursor: "move", appendTo: i.closest(".ipt_uif_sda_body"), stop: function (t, e) {
                    i.trigger("refreshWaypoints.eform")
                }})
        }, edRevealPassword: function () {
            var i = this, e = !1;
            this.jElement.on("mousedown", ".ipt-eform-password .ipticm", function () {
                e = !0, t(this).removeClass("ipt-icomoon-eye").addClass("ipt-icomoon-eye-slash"), t(this).closest(".ipt-eform-password").find(".ipt_uif_password").attr("type", "text")
            }), t("body").on("mouseup", function () {
                e && (i.jElement.find(".ipt-eform-password").each(function () {
                    var i = t(this);
                    i.find(".ipticm").removeClass("ipt-icomoon-eye-slash").addClass("ipt-icomoon-eye"), i.find(".ipt_uif_password").attr("type", "password")
                }), e = !1)
            })
        }, edApplyCountry: function () {
            var i = this;
            this.jElement.on("change", ".ipt-eform-address-country .ipt_uif_autocomplete", function () {
                i._updateProvince(t(this))
            })
        }, initUIElementsDelegated: function () {
            this.edApplyHelp(), this.edApplyMessage(), this.edCheckboxToggler(), this.edSliderInput(), this.edDateTimeNow(), this.edApplyPrintElement(), this.edApplyConditionalInput(), this.edApplyConditionalSelect(), this.edApplyCollapsible(), this.edApplyScrollToTop(), this.edApplyRating(), this.edApplySmileyRating(), this.edApplyLikeDislikeRating(), this.edApplyUploader(), this.edTabToggler(), this.edApplyWayPoints(), this.edApplyjSignature(), this.edApplyTimeCircles(), this.edApplyMathematicalEvaluator(), this.edApplyTrumbowyg(), this.edApplyPopupICM(), this.edApplySelectMenu(), this.edRevealPassword(), this.edApplyCountry(), this.edApplyPricingTable(), this.edApplyEstimationSlider(), this.edApplyLocationPicker(), this.edApplyTabIndexedLabels()
        }, edApplyTabIndexedLabels: function () {
            this.jElement.on("keydown", ".eform-label-with-tabindex", function (i) {
                13 !== i.keyCode && 32 !== i.keyCode || (i.preventDefault(), t(this).trigger("click"))
            })
        }, edApplyLocationPicker: function () {
            var e = this.jElement.find(".locationpicker-maps-control"), a = this;
            t(i).on("resize", t.debounce(250, function () {
                a._refreshLocationPickers(e)
            })), this.jElement.on("iptUIFCShow tabsactivate iptUICollapsible fsqm.rlp", function () {
                a._refreshLocationPickers(e)
            })
        }, edApplyEstimationSlider: function () {
            var i = this;
            this.jElement.on("change", ".eform-ui-est-values", t.debounce(250, function () {
                var e = t(this).closest(".eform-ui-estimator");
                i._positionEstimation(e)
            }))
        }, edApplyPricingTable: function () {
            this.jElement.on("click", ".eform-ui-pricing-table-element", function (i) {
                t(this).closest(".eform-ui-pricing-table-content").find(".eform-ui-pricing-table-element").removeClass("eform-pt-highlight")
            })
        }, edApplySelectMenu: function () {
            void 0 !== t.fn.select2 && this.jElement.on("select2:close", ".ipt_uif_select", function (i) {
                t(this).validationEngine("validate")
            })
        }, edApplyPopupICM: function () {
            this.jElement.on("click", ".eform-icmpopup", function (a) {
                a.preventDefault();
                var n = t(this).data("width"), s = t(this).data("height"), l = t(this).attr("href"), o = void 0 != i.screenLeft ? i.screenLeft : screen.left, r = void 0 != i.screenTop ? i.screenTop : screen.top, d = (i.innerWidth ? i.innerWidth : e.documentElement.clientWidth ? e.documentElement.clientWidth : screen.width) / 2 - n / 2 + o, p = (i.innerHeight ? i.innerHeight : e.documentElement.clientHeight ? e.documentElement.clientHeight : screen.height) / 2 - s / 2 + r, c = i.open(l, "eform-icmpopup", "scrollbars=yes, width=" + n + ", height=" + s + ", top=" + p + ", left=" + d);
                i.focus && c.focus()
            })
        }, edApplyTrumbowyg: function () {
            this.jElement.on("tbwblur", ".ipt-eform-trumbowyg", function (i) {
                t(this).trigger("change")
            })
        }, edApplyMathematicalEvaluator: function () {
            if ("undefined" != typeof exprEval) {
                var i = this;
                this.jElement.on("change fsqm.mathematicalReEvaluate", function (e) {
                    var a = t(e.target);
                    t(this).find(".ipt_uif_mathematical_input").each(function () {
                        if (t(this).is(a))
                            return!0;
                        try {
                            i.evaluateMathematicalFormula.apply(this, [i])
                        } catch (t) {
                            i.debugLog(t, !0)
                        }
                    })
                })
            }
        }, edApplyTimeCircles: function () {
            if (void 0 !== t.fn.TimeCircles) {
                var e = this.jElement;
                t(i).on("resize iptUIFCShow iptUIFCHide tabsactivate", t.debounce(250, function () {
                    e.find(".ipt_uif_circle_timer").each(function () {
                        t(this).TimeCircles().rebuild()
                    })
                }))
            }
        }, edApplyjSignature: function () {
            void 0 !== t.fn.jSignature && (this.jElement.on("click", ".ipt_uif_jsignature_undo", function () {
                t(this).closest(".ipt_uif_jsignature").find('.ipt_uif_jsignature_pad input[type="button"]').trigger("click")
            }), this.jElement.on("click", ".ipt_uif_jsignature_reset", function () {
                try {
                    t(this).closest(".ipt_uif_jsignature").find(".ipt_uif_jsignature_pad").jSignature("clear")
                } catch (t) {
                }
            }), this.jElement.on("change", ".ipt_uif_jsignature_pad", function (i) {
                if (t(this).is(":visible")) {
                    var e = t(this), a = e.jSignature("getData", "base30"), n = (a.join(","), e.siblings(".ipt_uif_jsignature_input").val(a));
                    e.data("eFormjSignatureUpdating") || n.validationEngine("validate"), n.trigger("change").trigger("blur")
                }
            }), this.jElement.on("iptUIFCShow tabsactivate fsqm.jSignatureRedraw", function (i) {
                setTimeout(t.proxy(function () {
                    t(this).find(".ipt_uif_jsignature_pad").filter(":visible").each(function () {
                        var i = t(this), e = i.prev(".ipt_uif_jsignature_input").val(), a = i.find("canvas").data("jSignature.this");
                        i.data("eFormjSignatureUpdating", !0), a ? (i.jSignature("destroy"), i.jSignature({lineWidth: 2, UndoButton: !0, signatureLine: !0}), "" !== e && "image/jsignature;base30," != e && i.jSignature("setData", e, "base30")) : (i.jSignature({lineWidth: 2, UndoButton: !0, signatureLine: !0}), "" !== e && "image/jsignature;base30," != e && i.jSignature("setData", e, "base30")), i.data("eFormjSignatureUpdating", !1)
                    })
                }, this), 500)
            }))
        }, edApplyWayPoints: function () {
            this.settings.demoMode || this.jElement.on("iptUIFCHide iptUIFCShow iptUICollapsible refreshWaypoints.eform", function () {
                try {
                    Waypoint.refreshAll()
                } catch (i) {
                    t.waypoints("refresh")
                }
            })
        }, edApplyUploader: function () {
            void 0 !== t.fn.fileupload && (this.jElement.on("dragover", ".fileinput-dragdrop", function () {
                t(this).addClass("hover")
            }), this.jElement.on("dragleave", ".fileinput-dragdrop", function () {
                t(this).removeClass("hover")
            }))
        }, edApplySmileyRating: function () {
            this.jElement.on("change", "input.ipt_uif_smiley_rating_radio", function (i) {
                var e = t(this).closest(".ipt_uif_rating");
                t(this).is(":checked") && e.find(".ipt_uif_smiley_rating_feedback_wrap") ? e.addClass("ipt_uif_smiley_feedback_active") : e.removeClass("ipt_uif_smiley_feedback_active")
            }), this.jElement.on("fsqm.check_smiley", function () {
                t(this).find(".ipt_uif_rating_smiley").each(function () {
                    t(this).find("input.ipt_uif_smiley_rating_radio:checked").length ? t(this).addClass("ipt_uif_smiley_feedback_active") : t(this).removeClass("ipt_uif_smiley_feedback_active")
                })
            })
        }, edApplyLikeDislikeRating: function () {
            this.jElement.on("change", "input.ipt_uif_likedislike_rating_radio", function (i) {
                var e = t(this).closest(".ipt_uif_rating");
                t(this).is(":checked") && e.find(".ipt_uif_likedislike_rating_feedback_wrap") ? e.addClass("ipt_uif_likedislike_feedback_active") : e.removeClass("ipt_uif_likedislike_feedback_active")
            }), this.jElement.on("fsqm.check_likedislike", function () {
                t(this).find("input.ipt_uif_likedislike_rating_radio:checked").length ? t(this).addClass("ipt_uif_likedislike_feedback_active") : t(this).removeClass("ipt_uif_likedislike_feedback_active")
            })
        }, edApplyRating: function () {
            this.jElement.on("mouseenter", ".ipt_uif_rating label", function () {
                t(this).siblings("input").removeClass("active"), t(this).prevAll("input").addClass("hover")
            }), this.jElement.on("mouseleave", ".ipt_uif_rating label", function () {
                t(this).prevAll("input").removeClass("hover"), t(this).siblings("input:checked").addClass("active").prevAll("input").addClass("active")
            }), this.jElement.on("change", ".ipt_uif_rating input", function () {
                t(this).is(":checked") && (t(this).nextAll("input").removeClass("active"), t(this).addClass("active"), t(this).prevAll("input").addClass("active"))
            })
        }, edTabToggler: function () {
            this.jElement.on("click", ".ipt_uif_tabs_toggler", function (i) {
                i.preventDefault(), i.stopPropagation(), t(this).siblings(".ui-tabs-nav").toggleClass("ipt_uif_tabs_toggle_active")
            })
        }, edApplyScrollToTop: function () {
            var i = this.jElement;
            this.jElement.on("click", ".ipt_uif_scroll_to_top", function (e) {
                e.preventDefault();
                var a = i.offset().top - 10, n = parseFloat(t("html").css("margin-top"));
                isNaN(n) && (n = 0), n += parseFloat(t("html").css("padding-top")), isNaN(n) && 0 === n || (a -= n), t("html, body").animate({scrollTop: a}, "fast")
            })
        }, edApplyMessage: function () {
            this.jElement.on("click", ".ipt_uif_message_close", function (i) {
                i.preventDefault(), t(this).closest(".ipt_uif_message").fadeOut("fast")
            })
        }, edApplyHelp: function (i) {
            this.jElement.on("click", ".ipt_uif_msg", function (i) {
                i.preventDefault();
                var e, a, n = t(this).find(".ipt_uif_msg_icon"), s = n.attr("title");
                void 0 !== s && "" !== s || (s = void 0 !== (e = n.parent().parent().siblings("th").find("label").html()) ? e : iptPluginUIFFront.L10n.help), a = t('<div><div style="padding: 10px;">' + n.next(".ipt_uif_msg_body").html() + "</div></div>");
                var l = {};
                l[iptPluginUIFFront.L10n.got_it] = function () {
                    t(this).dialog("close")
                }, a.dialog({autoOpen: !0, buttons: l, modal: !0, minWidth: 600, closeOnEscape: !0, title: s, create: function (i, e) {
                        t("body").addClass("ipt_uif_common")
                    }, close: function (i, e) {
                        t("body").removeClass("ipt_uif_common")
                    }})
            })
        }, edCheckboxToggler: function () {
            this.jElement.on("change", ".ipt_uif_checkbox_toggler", function () {
                var i = t(t(this).data("selector"));
                t(this).is(":checked") ? i.prop("checked", !0) : i.prop("checked", !1)
            })
        }, edSliderInput: function () {
            this.jElement.on("blur fsqm.slider", ".ipt_uif_slider", function () {
                var i, e, a, n, s = t(this), l = s.siblings(".ipt_uif_slider_count");
                s.hasClass("slider_range") ? (e = (i = s.siblings(".ipt_uif_slider_range_max")).siblings(".ipt_uif_slider_div"), a = [parseFloat(s.val()), parseFloat(i.val())], isNaN(a[0]) && (a[0] = 0), isNaN(a[1]) && (a[1] = 0), e.slider({values: a}), l.find("span.ipt_uif_slider_count_min").text(parseFloat(s.val()))) : (e = s.siblings(".ipt_uif_slider_div"), n = parseFloat(s.val()), isNaN(n) && (n = 0), e.slider({value: n}), l.find("span").text(parseFloat(s.val())))
            }), this.jElement.on("blur fsqm.slider", ".ipt_uif_slider_range_max", function () {
                var i = t(this), e = i.siblings(".ipt_uif_slider"), a = i.siblings(".ipt_uif_slider_div"), n = e.siblings(".ipt_uif_slider_count");
                a.slider({values: [parseFloat(e.val()), parseFloat(i.val())]}), n.find("span.ipt_uif_slider_count_max").text(parseFloat(i.val()))
            }), this.jElement.on("slide slidechange", ".ipt_uif_slider_div", function (i, e) {
                var a = t(this), n = a.siblings(".ipt_uif_slider_count"), s = a.siblings(".ipt_uif_slider"), l = a.siblings(".ipt_uif_slider_range_max");
                a.hasClass("ipt_uif_slider_range") ? (s.val(e.values[0]).trigger("change").validationEngine("validate"), l.val(e.values[1]).trigger("change").validationEngine("validate"), n.length && (n.find("span.ipt_uif_slider_count_min").text(e.values[0]), n.find("span.ipt_uif_slider_count_max").text(e.values[1]))) : (s.val(e.value).trigger("change").validationEngine("validate"), n.length && n.find("span").text(e.value))
            })
        }, edApplySpinner: function () {
            this.jElement.on("mousewheel", ".ipt_uif_uispinner", function () {
                t(this).trigger("change")
            })
        }, edDateTimeNow: function () {
            this.jElement.on("click", ".ipt_uif_datepicker_now", function () {
                t(this).nextAll(".ipt_uif_text").val("NOW")
            }), this.jElement.on("click", ".ipt_fsqm_container_datetime .ipticm", function () {
                t(this).closest(".ipt_fsqm_container_datetime").find(".ipt_uif_text").focus()
            }), this.jElement.on("click", ".eform-dp-clear", function (i) {
                i.preventDefault();
                var e = t(this).closest(".eform-dp-input-field").find("input.datepicker");
                e.val(""), e.addClass("is-empty"), e.trigger("blur");
                try {
                    e.validationEngine("validate")
                } catch (t) {
                }
            })
        }, edApplyPrintElement: function () {
            var i = this;
            this.jElement.on("click", ".ipt_uif_printelement", function () {
                t("#" + t(this).data("printid")).printElement({leaveOpen: !0, printMode: "popup", printBodyOptions: {classNameToAdd: "ipt_uif_common " + i.ui_theme_id, styleToAdd: "padding:10px;margin:10px;background: #fff none;color:#333;font-size:12px;"}, pageTitle: e.title})
            })
        }, edApplyConditionalInput: function () {
            this.jElement.on("change", ".ipt_uif_conditional_input", function (i) {
                var e, a, n = [], s = [];
                for (t(this).find("input").each(function(){e = "string" == typeof (e = t(this).data("condid"))?e.split(","):[], t(this).is(":checked")?n.push.apply(n, e):s.push.apply(s, e)}), a = 0; a < s.length; a++)
                    t("#" + s[a]).stop(!0, !0).hide();
                for (a = 0; a < n.length; a++)
                    t("#" + n[a]).stop(!0, !0).fadeIn("fast")
            })
        }, edApplyConditionalSelect: function () {
            this.jElement.on("change keyup", ".ipt_uif_conditional_select", function (i) {
                var e, a, n = [], s = [];
                for (t(this).find("select").find("option").each(function(){e = "string" == typeof (e = t(this).data("condid"))?e.split(","):[], t(this).is(":selected")?n.push.apply(n, e):s.push.apply(s, e)}), a = 0; a < s.length; a++)
                    t("#" + s[a]).stop(!0, !0).hide();
                for (a = 0; a < n.length; a++)
                    t("#" + n[a]).stop(!0, !0).fadeIn("fast")
            })
        }, edApplyCollapsible: function () {
            var i = this;
            this.jElement.on("click", ".ipt_uif_collapsible_handle_anchor", function (e) {
                var a = t(this).closest(".ipt_uif_collapsible").find("> .ipt_uif_container_inner");
                a.closest(".ipt_uif_collapsible").toggleClass("ipt_uif_collapsible_open"), a.slideToggle("normal", function () {
                    i.refreshiFrames(a), a.trigger("iptUICollapsible")
                })
            })
        }, edSDAattachDel: function () {
            var i = this;
            this.jElement.on("click", ".ipt_uif_sda_del", function (e) {
                e.preventDefault(), t(this).closest(".ipt_uif_sda").hasClass("eform-sda-reached-min") || i.edSDAdel(t(this))
            })
        }, edSDAdel: function (t) {
            var i = this, e = t.closest(".ipt_uif_sda_elem"), a = t.closest(".ipt_uif_sda"), n = a.find("> .ipt_uif_sda_foot button.ipt_uif_sda_button"), s = a.data("iptSDAdata"), l = 0;
            e.slideUp("fast", function () {
                e.stop().remove(), l = a.find("> .ipt_uif_sda_body > .ipt_uif_sda_elem").length, "" !== s.max && s.max > 0 && l < s.max && n.show(), "" !== s.min && s.min > 0 && (l <= s.min ? a.addClass("eform-sda-reached-min") : a.removeClass("eform-sda-reached-min")), 0 == l ? a.addClass("ipt-uif-sda-empty") : a.removeClass("ipt-uif-sda-empty"), a.trigger("fsqm.conditional").trigger("fsqm.mathematicalReEvaluate"), i.jElement.trigger("refreshWaypoints.eform")
            }).css({opacity: 1}).animate({opacity: 0}, "fast")
        }, edSDAattachAdd: function () {
            var i = this;
            this.jElement.on("click", ".ipt_uif_sda_foot button.ipt_uif_sda_button", function (e) {
                e.preventDefault();
                var a, n = t(this), s = n.closest(".ipt_uif_sda"), l = s.data("iptSDAdata"), o = s.find("> .ipt_uif_sda_data").text(), r = l.count++, d = new RegExp(i.quote(l.key), "g");
                o = (o = t("<div></div>").html(o).text()).replace(d, r), a = t('<div class="ipt_uif_sda_elem" />').append(t(o)), s.find("> .ipt_uif_sda_body").append(a), a.iptPluginUIFFront({applyUIOnly: !0}), a.hide().slideDown("fast").css({opacity: 0}).animate({opacity: 1}, "fast", function () {
                    var i = a.find("input, select, textarea").eq(0);
                    i.focus(), i.is("input") && (i.addClass("tabbed"), i.one("blur", function () {
                        t(this).removeClass("tabbed")
                    }))
                }), n.data("count", l.count), n.attr("data-count", l.count);
                var p = s.find("> .ipt_uif_sda_body > .ipt_uif_sda_elem").length;
                "" !== l.max && l.max > 0 && p >= l.max && n.hide(), "" !== l.min && l.min > 0 && (p <= l.min ? s.addClass("eform-sda-reached-min") : s.removeClass("eform-sda-reached-min")), 0 == p ? s.addClass("ipt-uif-sda-empty") : s.removeClass("ipt-uif-sda-empty"), s.trigger("fsqm.conditional").trigger("fsqm.mathematicalReEvaluate"), i.jElement.trigger("refreshWaypoints.eform")
            })
        }, evaluateMathematicalFormula: function (i) {
            var e, a = t(this), n = a.data("formula");
            if (n) {
                var s = a.data("precision"), l = a.data("options"), o = a.data("noanim");
                l || (l = {});
                var r, d, p = exprEval.Parser.parse(n.toString()).simplify(), c = p.variables(), u = {};
                for (e in c)
                    u[c[e]] = i.getMathematicalValue.apply(i, [c[e]]);
                try {
                    r = p.evaluate(u)
                } catch (t) {
                    r = 0
                }
                if (isNaN(r) && (r = 0), "" === s ? s = i.decimalPlaces(r) : (s = i.intelParseFloat(s), r = r.toFixed(s)), d = a.val(), a.val(r), d != r) {
                    a.trigger("fsqm.conditional").trigger("fsqm.mathematicalReEvaluate").trigger("change");
                    var f = t(this).next("span.ipt_uif_mathematical_span");
                    if (f.length && !1 === o) {
                        var h = null, m = f.data("iptUIFMathCU");
                        void 0 !== m && m.reset(), (h = f.data("iptUIFMathPV")) && void 0 !== h || (h = i.intelParseFloat(f.text())), isFinite(h) || (h = 0), (m = new CountUp(f.get(0), h, i.intelParseFloat(r), s, 2, l)).start(), f.data("iptUIFMathCU", m)
                    } else
                        f.length && f.html(i.formatNumber(r, s, l.decimal, l.useGrouping, l.separator));
                    f.data("iptUIFMathPV", i.intelParseFloat(r))
                }
            }
        }, getMathematicalValue: function (i) {
            var e = this.jElement, a = this, n = e.data("iptFSQMMathVarToElem");
            if (n || (e.data("iptFSQMMathVarToElem", {}), n = {}), void 0 === n[i]) {
                var s = /([MFO])(\d+)((R)(\d+))?((C)(\d+))?/gi.exec(i), l = {M: "mcq", F: "freetype", O: "pinfo"};
                if (null !== s && void 0 !== l[s[1]]) {
                    var o = e.find('[name="form_id"]').val(), r = "ipt_fsqm_form_" + o + "_" + l[s[1]] + "_" + s[2], d = t("#ipt_fsqm_form_" + o + "_" + l[s[1]] + "_" + s[2] + "_type").val();
                    n[i] = {elem: t("#" + r), parts: s, type: d}
                }
            }
            if (void 0 === n[i])
                return 0;
            if (n[i].elem.hasClass("iptUIFCHidden"))
                return 0;
            var p, c, u, f, h = 0;
            switch (n[i].type) {
                case"radio":
                case"p_radio":
                case"checkbox":
                case"p_checkbox":
                case"thumbselect":
                case"pricing_table":
                    void 0 == (u = n[i].parts[5]) ? n[i].elem.find("input").filter(":checked").each(function () {
                        c = a.intelParseFloat(t(this).data("num")), h += c
                    }) : n[i].elem.find("input").eq(u).each(function () {
                        t(this).is(":checked") && (h += a.intelParseFloat(t(this).data("num")))
                    });
                    break;
                case"select":
                case"p_select":
                    n[i].elem.find("select > option:selected").each(function () {
                        c = a.intelParseFloat(t(this).data("num")), h += c
                    });
                    break;
                case"slider":
                    h += a.intelParseFloat(n[i].elem.find("input.ipt_uif_slider").val());
                    break;
                case"range":
                    f = n[i].parts[8], h += void 0 == f || 0 == f ? a.intelParseFloat(n[i].elem.find("input.ipt_uif_slider").val()) : a.intelParseFloat(n[i].elem.find("input.ipt_uif_slider_range_max").val());
                    break;
                case"grading":
                    p = n[i].parts[5], f = n[i].parts[8], void 0 === p ? void 0 == f || 0 == f ? n[i].elem.find("input.ipt_uif_slider").each(function () {
                        h += a.intelParseFloat(t(this).val())
                    }) : n[i].elem.find("input.ipt_uif_slider_range_max").each(function () {
                        h += a.intelParseFloat(t(this).val())
                    }) : h += void 0 == f || 0 == f ? a.intelParseFloat(n[i].elem.find("input.ipt_uif_slider").eq(p).val()) : a.intelParseFloat(n[i].elem.find("input.ipt_uif_slider_range_max").eq(p).val());
                    break;
                case"starrating":
                case"scalerating":
                    void 0 === (p = n[i].parts[5]) ? n[i].elem.find(".ipt_uif_rating").each(function () {
                        h += a.intelParseFloat(t(this).find("input:checked").val())
                    }) : h += a.intelParseFloat(n[i].elem.find(".ipt_uif_rating").eq(p).find("input:checked").val());
                    break;
                case"spinners":
                    void 0 === (p = n[i].parts[5]) ? n[i].elem.find("input.ipt_uif_uispinner").each(function () {
                        h += a.intelParseFloat(t(this).val())
                    }) : h += a.intelParseFloat(n[i].elem.find("input.ipt_uif_uispinner").eq(p).val());
                    break;
                case"feedback_small":
                case"textinput":
                case"keypad":
                    h += a.intelParseFloat(n[i].elem.find("input.ipt_uif_text").val());
                    break;
                case"mathematical":
                    h += a.intelParseFloat(n[i].elem.find("input.ipt_uif_mathematical_input").val());
                    break;
                case"toggle":
                    h = n[i].elem.find("input.ipt_uif_switch").is(":checked") ? 1 : 0;
                    break;
                case"s_checkbox":
                    h = n[i].elem.find("input.ipt_uif_checkbox").is(":checked") ? 1 : 0;
                    break;
                case"smileyrating":
                    var m = n[i].elem.find("input.ipt_uif_radio").filter(":checked");
                    h = m.length ? a.intelParseFloat(m.data("num")) : 0;
                    break;
                case"likedislike":
                    var _ = n[i].elem.find("input.ipt_uif_radio").filter(":checked").val();
                    h = "like" == _ ? 1 : 0;
                    break;
                case"matrix_dropdown":
                    h = 0, u = n[i].parts[5], f = n[i].parts[8], void 0 !== u && void 0 !== f ? n[i].elem.find("tbody > tr").eq(u).find("select.ipt_uif_select").eq(f).find("option:selected").each(function () {
                        h += a.intelParseFloat(t(this).data("num"))
                    }) : void 0 !== u && void 0 === f ? n[i].elem.find("tbody > tr").eq(u).find("select.ipt_uif_select").find("option:selected").each(function () {
                        h += a.intelParseFloat(t(this).data("num"))
                    }) : void 0 === u && void 0 !== f ? n[i].elem.find("tbody > tr").each(function () {
                        t(this).find("select.ipt_uif_select").eq(f).find("option:selected").each(function () {
                            h += a.intelParseFloat(t(this).data("num"))
                        })
                    }) : n[i].elem.find("select.ipt_uif_select").find("option:selected").each(function () {
                        h += a.intelParseFloat(t(this).data("num"))
                    });
                    break;
                case"matrix":
                    u = n[i].parts[5], f = n[i].parts[8], h = 0, void 0 !== u && void 0 !== f ? n[i].elem.find("tbody > tr").eq(u).find(".ipt_uif_radio , .ipt_uif_checkbox").eq(f).filter(":checked").each(function () {
                        h += a.intelParseFloat(t(this).data("num"))
                    }) : void 0 !== u && void 0 === f ? n[i].elem.find("tbody > tr").eq(u).find(".ipt_uif_radio , .ipt_uif_checkbox").filter(":checked").each(function () {
                        h += a.intelParseFloat(t(this).data("num"))
                    }) : void 0 === u && void 0 !== f ? n[i].elem.find("tbody > tr").each(function () {
                        t(this).find(".ipt_uif_radio , .ipt_uif_checkbox").eq(f).filter(":checked").each(function () {
                            h += a.intelParseFloat(t(this).data("num"))
                        })
                    }) : n[i].elem.find(".ipt_uif_radio , .ipt_uif_checkbox").filter(":checked").each(function () {
                        h += a.intelParseFloat(t(this).data("num"))
                    });
                    break;
                case"repeatable":
                    u = n[i].parts[5], f = n[i].parts[8], h = 0, void 0 !== u && void 0 !== f ? n[i].elem.find(".ipt_uif_sda_elem").eq(u).find("> .ipt_uif_column").eq(f).each(function () {
                        h += a._repeatableMathematicalValue(t(this))
                    }) : void 0 !== u && void 0 === f ? n[i].elem.find(".ipt_uif_sda_elem").eq(u).each(function () {
                        h += a._repeatableMathematicalValue(t(this))
                    }) : void 0 === u && void 0 !== f ? n[i].elem.find(".ipt_uif_sda_elem").each(function () {
                        t(this).find("> .ipt_uif_column").eq(f).each(function () {
                            h += a._repeatableMathematicalValue(t(this))
                        })
                    }) : h += a._repeatableMathematicalValue(n[i].elem);
                    break;
                case"datetime":
                    (h = n[i].elem.find(".ipt_uif_datepicker, .ipt_uif_datetimepicker").val()) ? (h = new Date(h.replace(/-/g, "/")), h = Math.floor(h / 864e5)) : h = 0;
                    break;
                default:
                    a.debugLog("Error! Element not supported by mathematical evaluator. Element variable: " + i, !0), h = 0
            }
            return e.data("iptFSQMMathVarToElem", n), h
        }, testImage: function (t) {
            return/\.(gif|jpg|jpeg|tiff|png)$/i.test(t)
        }, quote: function (t) {
            return t.replace(/([.?*+^$[\]\\(){}|-])/g, "\\$1")
        }, stripTags: function (i) {
            var e, a = t("<div />");
            return a.html(i), e = a.text(), a.remove(), e
        }, intelParseFloat: function (t, i) {
            void 0 === i && (i = 0);
            var e = parseFloat(t);
            return isNaN(e) && (e = i), e
        }, isNumeric: function (t) {
            return!isNaN(parseFloat(t)) && isFinite(t)
        }, decimalPlaces: function (t) {
            var i = ("" + t).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
            return i ? Math.max(0, (i[1] ? i[1].length : 0) - (i[2] ? +i[2] : 0)) : 0
        }, _repeatableMathematicalValue: function (i) {
            var e = 0, a = this;
            return i.find('input[type="radio"], input[type="checkbox"]').filter(":checked").each(function () {
                e += a.intelParseFloat(t(this).data("num"))
            }), i.find("select option").filter(":selected").each(function () {
                e += a.intelParseFloat(t(this).data("num"))
            }), i.find("input.ipt_uif_text").each(function () {
                e += a.intelParseFloat(t(this).val())
            }), e
        }, formatNumber: function (t, i, e, a, n) {
            i = isNaN(i = Math.abs(i)) ? 2 : i, e = void 0 === e ? "." : e, n = void 0 === n ? "," : n, !0 !== (a = void 0 === a || a) && (n = "");
            var s = t < 0 ? "-" : "", l = parseInt(t = Math.abs(+t || 0).toFixed(i), 10) + "", o = (o = l.length) > 3 ? o % 3 : 0;
            return s + (o ? l.substr(0, o) + n : "") + l.substr(o).replace(/(\d{3})(?=\d)/g, "$1" + n) + (i ? e + Math.abs(t - l).toFixed(i).slice(2) : "")
        }, refreshiFrames: function () {
//            var e = t(this);
//            if (e.find("iframe").each(function () {
//                t(this).closest(".g-recaptcha").length || t(this).attr("src", t(this).attr("src"))
//            }), e.find("video").each(function () {
//                try {
//                    this.pause()
//                } catch (t) {
//                    console && console.log && console.log(t)
//                }
//            }), void 0 != i.mejs)
//                try {
//                    t(".wp-video-shortcode").each(function () {
//                        var e = t(this), a = e.attr("width"), n = e.attr("height"), s = e.closest(".mejs-container").attr("id");
//                        i.mejs.players[s].setPlayerSize(a, n)
//                    })
//                } catch (t) {
//                    console.log(t)
//                }
        }, dates: {convert: function (t) {
                return t.constructor === Date ? t : t.constructor === Array ? new Date(t[0], t[1], t[2]) : t.constructor === Number ? new Date(t) : t.constructor === String ? new Date(t) : "object" == typeof t ? new Date(t.year, t.month, t.date) : NaN
            }, compare: function (t, i) {
                return isFinite(t = this.convert(t).valueOf()) && isFinite(i = this.convert(i).valueOf()) ? (t > i) - (t < i) : NaN
            }, inRange: function (t, i, e) {
                return isFinite(t = this.convert(t).valueOf()) && isFinite(i = this.convert(i).valueOf()) && isFinite(e = this.convert(e).valueOf()) ? i <= t && t <= e : NaN
            }}, _updateProvince: function (t, i) {
            void 0 === i && (i = !1);
            var e, a, n, s = null, l = null;
            if (i)
                s = (a = t).data("presetCountry");
            else {
                if (!(s = t.val()) || "" === s)
                    return;
                if (!(a = t.closest(".ipt_fsqm_container_address").find(".ipt-eform-address-province .ipt_uif_autocomplete")).length)
                    return
            }
            for (e in this.countryList)
                if (i && s == this.countryList[e].value || !i && s == this.countryList[e].label) {
                    l = e;
                    break
                }
            null != l ? (a.parent().addClass("working"), (n = this.countryList[l].data.provinces) ? a.autocomplete("option", "source", n) : a.autocomplete("option", "source", []), a.parent().removeClass("working")) : a.autocomplete("option", "source", [])
        }, _positionEstimation: function (t) {
            var i, e, a = t.find(".eform-ui-estimator-slide .eform-ui-estimator-slide-active"), n = t.data("config"), s = t.find(".eform-ui-estimator-bubble"), l = this._getEstimationSliderValues(t), o = n.area;
            o = this.intelParseFloat(o), i = this._getEstimationSliderPosition(o, l), this._positionEstimationSlide(a, i), s.length && (e = this._getEstimationBubblePosition(t.width(), s.width(), l, i), this._positionEstimationBubble(s, e))
        }, _positionEstimationSlide: function (t, i) {
            t.css({left: i.left + "%", width: i.width + "%"})
        }, _positionEstimationBubble: function (t, i) {
            t.css({left: i.left + "%"}), t.find(".eform-ui-est-bub-tip").css({left: i.tipLeft + "%"})
        }, _getEstimationSliderPosition: function (t, i) {
            var e = {left: 0, width: 0};
            return i && i.length ? (1 == i.length ? e.width = i[0] / t * 100 : (e.left = i[0] / t * 100, e.width = (i[1] - i[0]) / t * 100), e.left > 100 && (e.left = 100), e.width > 100 && (e.width = 100), e.left + e.width > 100 && (98 < e.left ? (e.left = 98, e.width = 2) : e.width = 100 - e.left), e) : e
        }, _getEstimationBubblePosition: function (t, i, e, a) {
            var n, s, l = {left: 0, tipLeft: 50};
            return e && e.length ? (n = i / t * 100, 1 == e.length ? (l.left = a.width - n / 2, l.left < 0 ? (l.tipLeft = a.width / n * 100, l.left = 0) : l.left + n > 100 && (l.tipLeft = (a.width - (100 - n)) / n * 100, l.left = 100 - n)) : (s = a.left + a.width / 2, l.left = s - n / 2, l.left < 0 ? (l.tipLeft = s / n * 100, l.left = 0) : l.left + n > 100 && (l.tipLeft = (s - (100 - n)) / n * 100, l.left = 100 - n)), l.tipLeft < 10 ? l.tipLeft = 10 : l.tipLeft > 90 && (l.tipLeft = 90), l) : l
        }, _getEstimationSliderValues: function (i) {
            var e = [], a = this;
            return i.find(".eform-ui-est-values .ipt_uif_mathematical_input").each(function () {
                e.push(a.intelParseFloat(t(this).val()))
            }), e
        }, _refreshLocationPickers: function (i) {
            i.filter(":visible").each(function () {
                t(this).locationpicker("autosize")
            })
        }, yourOtherFunction: function () {}};
    var o = {init: function (i) {
            return this.each(function () {
                t.data(this, "plugin_" + n) || t.data(this, "plugin_" + n, new l(this, i))
            })
        }, refreshiFrames: function () {
            var i = t(this);
            return i.find("iframe").each(function () {
                t(this).closest(".g-recaptcha").length || t(this).attr("src", t(this).attr("src"))
            }), i.find("video").each(function () {
                try {
                    this.pause()
                } catch (t) {
                    console && console.log && console.log(t)
                }
            }), this
        }};
    t.fn[n] = function (i) {
        return o[i] ? o[i].apply(this, Array.prototype.slice.call(arguments, 1)) : ("object" != typeof i && i ? t.error("Method " + i + " does not exist on jQuery." + n) : o.init.apply(this, arguments), this)
    }
}(jQuery, window, document);