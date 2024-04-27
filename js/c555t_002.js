!function (t, i, e, s) {
    "use strict";
    var n = "iptFSQMForm", a = {demoMode: !1, demoTab: 0};
    function r(i, e) {
        this.element = i, this.jElement = t(i), this.settings = t.extend({}, a, e), this._defaults = a, this._name = n, this.init()
    }
    i.eFormreCaptchaLoad = function () {
        t(".ipt_fsqm_form").each(function () {
            var i = t(this), e = i.find(".g-recaptcha").eq(0), s = e.prev("input");
            if (e.length) {
                var n = {sitekey: e.data("sitekey"), theme: e.data("theme"), type: e.data("type"), size: e.data("size"), callback: function (t) {
                        s.val(t), i.data("reCaptchaValidated", !0), i.find("form.ipt_uif_validate_form").validationEngine("hideAll")
                    }, "expired-callback": function () {
                        s.val(""), i.data("reCaptchaValidated", !1)
                    }};
                grecaptcha.render(e.get(0), n)
            }
            i.data("reCaptchaValidated", !1)
        })
    }, r.prototype = {init: function () {
            var i = this, s = 1 == this.jElement.data("eformanim"), n = [];
            if (t("#ipt_fsqm_primary_css-css").length && (n[n.length] = {id: "ipt_fsqm_primary_css", src: iptFSQM.location + "css/form.css?version=" + iptFSQM.version}), "undefined" != typeof wp && void 0 !== wp.customize) {
                var a = this.jElement.find(".ipt_uif_init_loader .ipt_uif_ajax_loader_inner");
                return a.removeClass("ipt_uif_ajax_loader_animate"), a.find(".ipt_uif_ajax_loader_text").text(iptFSQM.l10n.customizer_msg), void(console && console.warn && console.warn("Customizer Detected. Shutting Down eForm"))
            }
            this.initBasicVariables(), this.settings.demoMode || (this.applySayt(), this._restoreStopwatchVal()), this.jElement.iptPluginUIFFront({demoMode: this.settings.demoMode, callback: function () {
                    i.initVariables(), 
                    i.applyFSQM(), 
                    i.settings.demoMode || (i._saytRestoreTab(), i.applyGoogleAnalytics(), 
                    i.applyLogins())
//                    t(e).trigger("formLoaded.eform")
                }, additionalThemes: n, waypoints: !this.settings.demoMode && s})
        }, initBasicVariables: function () {
            this.main_tab = this.jElement.find(".ipt_fsqm_main_tab"), this.main_form = this.jElement.find("form.ipt_fsqm_main_form"), this.form_id = this.jElement.find('input[name="form_id"]').val(), this.data_id = this.jElement.find('input[name="data_id"]').val(), this.restore_block = this.jElement.find(".ipt_fsqm_form_message_restore"), this.validation_block = this.jElement.find(".ipt_fsqm_form_validation_error"), this.interval_save_button = this.jElement.find(".ipt_fsqm_form_button_interval_save"), this.sayt_settings = this.jElement.data("fsqmsayt"), this.formReset = this.jElement.data("fsqmreset"), this.regSettings = this.jElement.data("eformreg"), this.eFormCookie = this.jElement.data("eformCookie"), this.reCaptchaNeeded = !1, this.jElement.find(".ipt_fsqm_container_recaptcha").length && (this.reCaptchaNeeded = !0), this.settings.demoMode && this.main_tab.data("demoActive", this.settings.demoTab)
        }, initVariables: function () {
            this.main_pb = this.jElement.find(".ipt_fsqm_main_pb"), this.button_container = this.jElement.find(".ipt_fsqm_form_button_container"), this.prev_button = this.button_container.find(".ipt_fsqm_form_button_prev"), this.next_button = this.button_container.find(".ipt_fsqm_form_button_next"), this.submit_button = this.button_container.find(".ipt_fsqm_form_button_submit"), this.reset_button = this.button_container.find(".ipt_fsqm_form_button_reset"), this.terms_wrap = this.jElement.find(".ipt_fsqm_terms_wrap"), this.tabIndices = this.main_tab.find("ul.ui-tabs-nav").eq(0).find("> li"), this.process = this.jElement.find(".ipt_fsqm_form_message_process"), this.success = this.jElement.find(".ipt_fsqm_form_message_success"), this.http_error = this.jElement.find(".ipt_fsqm_form_message_error"), this.timerTabFormSync = {timerEnabled: !1, forceProgress: !1, forceSubmit: !1}, this.nonce_interval = void 0, this.ga_tracker_name = "", this.ga_cache = {}, this.fsqm_ga_data = this.jElement.data("fsqmga"), this.ui_type = this.jElement.data("uiType"), this.hidden_button = this.jElement.data("hiddenButtons"), this.tab_settings = this.main_tab.data("settings"), this.scroll_settings = this.jElement.data("eformscroll"), this.fsqm_submitting = !1, this.skipping_tab_for_conditional = !1, this.restoring_form = !1, this.sayt_restoring_tab = !1, this.jumping_on_button = !1, this.changing_tab_on_submit_error = !1, this.changing_tab_on_timer = !1, this.auto_progressing = !1, this.auto_progress_timer = !1, this.sayt_interval_saving = !1, this.on_last_page = !1, this.main_tab.length || (this.on_last_page = !0), this.block_prev_on_timer = !1, this.preSubmissionHooks = []
        }, initStripe: function () {
            if (this.stripe = {has: !1, container: null, wrapper: null, elements: null, stripe: null, card: null}, this.jElement.find("#ipt_fsqm_form_" + this.form_id + "_payment_stripe").length && i.Stripe) {
                this.stripe.has = !0, this.stripe.container = this.jElement.find("#ipt_fsqm_form_" + this.form_id + "_payment_stripe"), this.stripe.wrapper = this.stripe.container.closest(".eform-stripe-checkout"), this.stripe.stripe = Stripe(this.stripe.container.data("stripePubKey")), this.stripe.elements = this.stripe.stripe.elements(), this.stripe.card = this.stripe.elements.create("card", {style: {base: {fontSize: "16px", lineHeight: "32px", color: this.stripe.container.css("color")}}, hidePostalCode: !0, iconStyle: "default"}), this.stripe.card.mount("#ipt_fsqm_form_" + this.form_id + "_payment_stripe");
                var t = this;
                this.stripe.card.on("change", function (i) {
                    t.stripe.container.validationEngine("hide"), i.error && t.stripe.container.validationEngine("showPrompt", i.error.message, "red")
                }), this.preSubmissionHooks[this.preSubmissionHooks.length] = {callback: function (t) {
                        if (this.jElement.data("subscription-form") && this.jElement.find(".eform-stripe-saved-cards").length && "new" != this._getStripeSubscriptionSource())
                            this._processPreSubmissionHooks(t);
                        else if (this.stripe.wrapper.closest(".iptUIFCHidden").length)
                            this._processPreSubmissionHooks(t);
                        else {
                            var i = {name: this.stripe.wrapper.find(".ipt_uif_cc_name").val(), address_zip: this.stripe.wrapper.find(".ipt_uif_cc_zip").val()}, e = this.stripe.wrapper.find(".eform-stripe-checkout-country select option:selected").data("iso"), s = this;
                            e.alpha2 && (i.address_country = e.alpha2), this.stripe.stripe.createToken(this.stripe.card, i).then(function (i) {
                                t.stripe = i, s._processPreSubmissionHooks(t)
                            })
                        }
                    }}
            }
        }, _getStripeSubscriptionSource: function () {
            var t = this.jElement.find(".eform-stripe-saved-cards .ipt_uif_radio").filter(":checked");
            return!!t.length && t.val()
        }, applyLogins: function () {
            var t;
//            if (this.regSettings && (!0 === iptFSQM.core.logged_in && !0 === this.regSettings.enabled && (this.jElement.find("#ipt_fsqm_form_" + this.form_id + "_pinfo_" + this.regSettings.username_id).hide(), this.jElement.find("#ipt_fsqm_form_" + this.form_id + "_pinfo_" + this.regSettings.password_id).hide(), !0 === this.regSettings.hide_pinfo && (this.jElement.find(".ipt_fsqm_container_f_name").hide(), this.jElement.find(".ipt_fsqm_container_l_name").hide(), this.jElement.find(".ipt_fsqm_container_email").hide()), !0 === this.regSettings.hide_meta)))
//                for (t in this.regSettings.meta)
//                    this.jElement.find("#ipt_fsqm_form_" + this.form_id + "_" + this.regSettings.meta[t].m_type + "_" + this.regSettings.meta[t].key).hide()
        }, applyGoogleAnalytics: function () {
//            var s, n, a, r, o, _, m = this, h = "", l = {mcq: "Multiple Choice Questions (M)", freetype: "Feedback and Upload (F)", pinfo: "Other Form Elements (O)"}, c = {mcq: "M", freetype: "F", pinfo: "O"};
//            if ("object" == typeof this.fsqm_ga_data && !0 === this.fsqm_ga_data.enabled && (h = !0 === this.fsqm_ga_data.user_update ? "FSQM Update: " + this.fsqm_ga_data.form_id : "FSQM New Submission: " + this.fsqm_ga_data.form_id, void 0 !== i.ga && !0 !== this.fsqm_ga_data.manual_load || "" === this.fsqm_ga_data.tracking_id || (n = e, a = "script", r = "ga", (s = i).GoogleAnalyticsObject = r, s.ga = s.ga || function () {
//                (s.ga.q = s.ga.q || []).push(arguments)
//            }, s.ga.l = 1 * new Date, o = n.createElement(a), _ = n.getElementsByTagName(a)[0], o.async = 1, o.src = "https://www.google-analytics.com/analytics.js", _.parentNode.insertBefore(o, _)), void 0 !== i.ga)) {
//                ga("create", {trackingId: this.fsqm_ga_data.tracking_id, cookieDomain: this.fsqm_ga_data.cookie, name: "FSQM" + this.fsqm_ga_data.form_id}), this.ga_tracker_name = "FSQM" + this.fsqm_ga_data.form_id + ".";
//                var f = {dimension1: "", dimension2: "", dimension3: "", dimension4: ""};
//                ga(this.ga_tracker_name + "send", "pageview"), this.jElement.on("tabsactivate", function (t, i) {
//                    if (!(m.skipping_tab_for_conditional || m.restoring_form || m.sayt_restoring_tab || m.changing_tab_on_submit_error)) {
//                        var e = m.tabIndices.index(i.oldTab), s = i.oldTab.text();
//                        ga(m.ga_tracker_name + "send", "event", h, "Pagination", s, {dimension5: e.toString()})
//                    }
//                }), this.jElement.on("blur change", ".ipt_uif_conditional", function (i) {
//                    if (void 0 !== i.originalEvent) {
//                        var e = t(this), s = e.prev().prev().val();
//                        if (-1 != t.inArray(s, ["mcq", "freetype", "pinfo"])) {
//                            var n = t(this).find(".check_me"), a = !1, r = e.prev().val(), o = /ipt_fsqm_form_([0-9]+)_(mcq|freetype|pinfo)_([0-9]+)/gi.exec(e.attr("id"))[3], _ = m._getElementValues(e, r), d = e.find("> .ipt_uif_column_inner > .ipt_uif_question > .ipt_uif_question_label > .ipt_uif_question_title").length ? e.find("> .ipt_uif_column_inner > .ipt_uif_question > .ipt_uif_question_label > .ipt_uif_question_title") : e.find("label").eq(0), p = "(" + c[s] + "){" + o + "} " + d.text();
//                            if (!1 === _ || void 0 === _)
//                                return;
//                            n.length && (a = n.validationEngine("validateSilent"));
//                            var u = "Completed";
//                            !0 === a && (u = "Skipped"), _ = "object" == typeof _ ? _.join(", ") : _.toString(), f.dimension1 = l[s], f.dimension2 = r, f.dimension3 = o, f.dimension4 = _, ga(m.ga_tracker_name + "send", "event", h, u, p, f)
//                        }
//                    }
//                }), this.jElement.on("submit", function () {
//                    ga(m.ga_tracker_name + "send", "event", h, "Submit", m.fsqm_ga_data.name)
//                })
//            }
        }, applySayt: function () {
            if (void 0 !== t.fn.sayt) {
                var e = this;
                void 0 !== this.sayt_settings && !1 === this.sayt_settings.admin_override && !1 === this.sayt_settings.user_update && !0 === this.sayt_settings.auto_save ? (!0 === this.sayt_settings.restore && !0 === this.main_form.sayt({autosave: !1, checksaveexists: !0}) ? (this.main_form.sayt({recover: !0}), this.sayt_settings.show_restore && (this.restore_block.fadeIn("fast"), this.restore_block.on("click", ".ipt_fsqm_form_message_close", function (t) {
                    t.preventDefault(), e.restore_block.slideUp("fast")
                }))) : this.restore_block.hide(), !0 === this.sayt_settings.interval_save ? (this.sayt_settings.interval > 0 && (this.saytIntervalID = i.setInterval(function () {
                    e.saytManualSave()
                }, 1e3 * this.sayt_settings.interval)), this.interval_save_button.length && this.interval_save_button.on("click", function (i) {
                    i.preventDefault(), e.saytManualSave();
                    var s = t(this);
                    s.tooltipster("close"), setTimeout(function () {
                        s.tooltipster("content", s.data("stitle")), s.tooltipster("open")
                    }, 500)
                })) : this.main_form.sayt({autosave: !0, autorecover: !1, days: 30, exclude: [".ipt_fsqm_sayt_exclude"]}), this.jElement.on("click", ".ipt_fsqm_form_message_restore .ipt_fsqm_sayt_reset", function (i) {
                    i.preventDefault(), e._restoreForm(), t(this).closest(".ipt_fsqm_form_message_restore").slideUp("fast")
                })) : this.restore_block.hide()
            }
        }, saytManualSave: function () {
            void 0 !== t.fn.sayt && !0 !== this.sayt_interval_saving && (this.sayt_interval_saving = !0, this.main_form.sayt({autosave: !1, autorecover: !1, days: 30, exclude: [".ipt_fsqm_sayt_exclude"], savenow: !0}), this.sayt_interval_saving = !1)
        }, applyFSQM: function () {
            this.settings.demoMode || this._refreshStartupTimer(), this.applyFormEvents(), this.applyTimerEvent(), this.applyTabEvents(), this.settings.demoMode || this.applyAutoProgress(), this.applyNonceEvents(), this.applyCoupons(), this.settings.demoMode || this.applyStopwatch(), this.settings.demoMode || this.applyIntervalTooltipster(), this.initStripe(), this.initInteractive()
        }, initInteractive: function () {
            var t = this.jElement.find(".eform-react-helper-matches");
            t.length && this.jElement.eFormInteractive({elements: t.data("matches"), formId: this.form_id})
        }, applyIntervalTooltipster: function () {
            if (this.interval_save_button.length) {
                var t = this.interval_save_button;
                this.interval_save_button.tooltipster("instance").on("closing", function () {
                    t.tooltipster("content", t.data("otitle"))
                })
            }
        }, applyStopwatch: function () {
            var t = this.jElement.find(".ipt_fsqm_form_stopwatch"), i = this.jElement.find(".ipt_fsqm_form_stopwatch_val");
            t.length && t.TimeCircles().addListener(function (t, e, s) {
                i.val(s)
            }, "all")
        }, applyCoupons: function () {
            var i = this.jElement.find(".ipt_uif_coupon_button");
            0 !== i.length && (i.on("click", function (i) {
                i.preventDefault();
                var e = t(this).prop("disabled", !0), s = t(this).closest(".ipt_uif_coupon"), n = s.data("config"), a = s.find(".ipt_uif_coupon_message"), r = s.find(".ipt_uif_mathematical_input");
                if (e.find(".ui-button-text").html(n.wait), a.html(""), "" === s.find(".ipt_uif_coupon_text").val())
                    return e.prop("disabled", !1), e.find(".ui-button-text").html(n.normal), r.data("formula", r.attr("data-formula")), s.find(".ipt_uif_coupon_final").trigger("fsqm.mathematicalReEvaluate"), void s.trigger("fsqm.conditional");
                t.get(iptFSQM.ajaxurl, {action: n.action, _wpnonce: n.cnonce, form_id: n.form_id, coupon: s.find(".ipt_uif_coupon_text").val(), amount: s.closest(".ipt_fsqm_container_payment").find(".ipt_fsqm_payment_mathematical .ipt_uif_mathematical_input").val()}, function (t) {
                    a.html(t.msg).removeClass("msg_okay").removeClass("msg_error"), !0 === t.success ? (a.addClass("msg_okay"), r.data("formula", t.formula)) : (a.addClass("msg_error"), r.data("formula", r.attr("data-formula")))
                }).fail(function () {
                    a.addClass("msg_error"), r.data("formula", r.attr("data-formula")), alert(n.http_error)
                }).always(function () {
                    e.prop("disabled", !1), e.find(".ui-button-text").html(n.normal), s.find(".ipt_uif_coupon_final").trigger("fsqm.mathematicalReEvaluate"), s.trigger("fsqm.conditional")
                })
            }), this.jElement.find(".ipt_uif_coupon_text").on("keyup keypress", function (t) {
                if (13 === (t.keyCode || t.which))
                    return t.preventDefault(), i.trigger("click"), !1
            }), this.jElement.find(".ipt_uif_coupon_final").on("change", function () {
                i.trigger("click")
            }))
        }, applyNonceEvents: function () {
            if (this.jElement.find('input[name="form_id"]').length) {
                var i = void 0 === this.data_id ? null : this.data_id, e = this.jElement.find('input[name="ipt_fsqm_form_data_save"]'), s = this.jElement.find('input[name="ipt_fsqm_user_edit_nonce"]'), n = this.jElement.find('input[name="user_edit"]'), a = {form_id: this.form_id, action: "ipt_fsqm_refresh_nonce"};
                null !== i && (a.data_id = i), n.length && (a.user_edit = "1");
                var r = function () {
                    t.post(iptFSQM.ajaxurl, a, function (t, i, n) {
                        "object" == typeof t && !0 === t.success && (e.val(t.save_nonce), s.length && s.val(t.edit_nonce))
                    })
                };
                r(), this.nonce_interval = setInterval(r, 36e5)
            }
        }, applyAutoProgress: function () {
            if (void 0 !== this.tab_settings && !0 === this.tab_settings.auto_progress && this.main_tab.length) {
                var i = this;
                this.jElement.on("blur change", ".check_me", t.debounce(250, function () {
                    if (!0 !== i.auto_progressing) {
                        !1 !== i.auto_progress_timer && (clearTimeout(i.auto_progress_timer), i.auto_progress_timer = !1);
                        var e = parseInt(i.tab_settings.auto_progress_delay, 10);
                        (void 0 === e || isNaN(e)) && (e = 1500);
                        var s = !0;
                        i.main_tab.find('> div.ui-tabs-panel[aria-hidden="false"] .check_me').each(function () {
                            if (!0 === t(this).validationEngine("validateSilent"))
                                return s = !1, !1
                        }), !0 === s && (!0 !== i.on_last_page ? i.auto_progress_timer = setTimeout(function () {
                            i.auto_progressing = !0, i._navigateNextTab(), i.auto_progressing = !1, i.auto_progress_timer = !1
                        }, e) : i.auto_progress_timer = setTimeout(function () {
                            i.auto_progress_timer = !1, i.terms_wrap.length && !0 === i.terms_wrap.find(".check_me").validationEngine("validateSilent") || !0 === i.tab_settings.auto_submit && i.main_form.submit()
                        }, e))
                    }
                }))
            }
        }, applyFormEvents: function () {
            var i = this;
            this.main_form.on("submit", function (e) {
                if (e.preventDefault(), i.settings.demoMode)
                    return t("#eform-live-view-messages").fadeIn().html("Sorry form submission is not available in demo mode."), i._scrollToPosition(t("#eform-live-view-messages")), void setTimeout(function () {
                        t("#eform-live-view-messages").fadeOut()
                    }, 5e3);
                var s = !0;
                if (!0 !== i.timerTabFormSync.timerEnabled || !0 !== i.timerTabFormSync.forceSubmit) {
                    if (!0 === i.on_last_page) {
                        if (i._openRequiredCollapsedElements(i.main_form), 0 !== i.main_tab.length) {
                            if (i.main_tab.find('> div.ui-tabs-panel[aria-hidden="false"] .check_me').each(function () {
                                if (!0 === t(this).validationEngine("validate"))
                                    return s = !1, i._scrollToPosition(t(this), 200, 80), !1
                            }), !1 === s)
                                return!1;
                            if (i.terms_wrap.length && i.terms_wrap.find(".check_me").validationEngine("validate"))
                                return!1
                        } else if (!1 === i.main_form.validationEngine("validate"))
                            return!1;
                        return!1 !== i._checkUploadRequests(i.main_form) && (0 != i._checkForReCaptcha() && (i._processSubmission(), i._destroyTimer(!0), !0))
                    }
                    i._navigateNextTab()
                } else
                    i._processSubmission()
            })
        }, applyTabEvents: function () {
            var i = this;
            this.jElement.on("click", ".ipt_fsqm_jump_button", function (e) {
                if (e.preventDefault(), !i.main_tab.length)
                    return!1;
                i.jumping_on_button = !0, i.main_tab.tabs("option", "active", t(this).data("pos") - 1), i.jumping_on_button = !1
            }), this._onResetButton(), this.main_tab.length ? (2 == this.tab_settings.type && this.main_tab.find("ul.ui-tabs-nav").eq(0).hide(), this._initButtonsForTab(), this.main_tab.on("tabsbeforeactivate", function (e, s) {
                if (i.main_tab.is(t(e.target))) {
                    if (i.settings.demoMode)
                        return!0;
                    var n = i.tabIndices.index(s.oldTab), a = i.tabIndices.index(s.newTab), r = !0;
                    if (!0 === i.skipping_tab_for_conditional)
                        return!0;
                    if (!0 === i.restoring_form)
                        return!0 !== i._skipTabIfNecessary(s, a, n);
                    if (!0 === i.sayt_restoring_tab)
                        return!0 !== i._skipTabIfNecessary(s, a, n);
                    if (!0 === i.jumping_on_button && !0 !== i.timerTabFormSync.timerEnabled)
                        return!0 !== i._skipTabIfNecessary(s, a, n);
                    if (!0 === i.changing_tab_on_submit_error)
                        return!0 !== i._skipTabIfNecessary(s, a, n);
                    if (1 == i.tab_settings.any_tab)
                        return!0 !== i._skipTabIfNecessary(s, a, n);
                    if (1 == i.changing_tab_on_timer)
                        return!0 !== i._skipTabIfNecessary(s, a, n);
                    if (a > n && i.next_button.hasClass("iptUIFCHidden"))
                        return!1;
                    if (a > n && a - n > 1)
                        return i._navigateNextTab(), !1;
                    if (a < n) {
                        if (!0 === i.tab_settings.block_previous || !0 === i.block_prev_on_timer)
                            return!1;
                        if (!0 === i.tab_settings.can_previous)
                            return!0 !== i._skipTabIfNecessary(s, a, n)
                    }
                    return!0 === i.timerTabFormSync.forceProgress && !0 === i.timerTabFormSync.timerEnabled ? !0 !== i._skipTabIfNecessary(s, a, n) : (i._openRequiredCollapsedElements(s.oldPanel), s.oldPanel.find(".check_me").each(function () {
                        if (!0 === t(this).validationEngine("validate")) {
                            var e = t(this);
                            return r = !1, i.tab_settings.scroll_on_error && i._scrollToPosition(t(this), 200, 80), (e.hasClass("ipt_uif_text") || e.hasClass("ipt_uif_textarea")) && e.addClass("invalid").removeClass("valid"), !1
                        }
                    }), !1 !== r && (!1 !== i._checkUploadRequests(s.oldPanel) && (0 != i._checkForReCaptcha() && !0 !== i._skipTabIfNecessary(s, a, n))))
                }
            }), this.main_tab.on("tabsactivate", function (e, s) {
                if (i.main_tab.is(t(e.target))) {
                    var n = i.tabIndices.index(s.newTab);
                    if (2 == i.tab_settings.type && !0 === i.tab_settings.show_progress_bar) {
                        var a = n / i.tabIndices.length * 100;
                        a = +a.toFixed(i.tab_settings.decimal_point), i.main_pb.progressbar("option", "value", a)
                    }
                    i.main_form.find(".ipt_fsqm_form_tab_pos").val(n).trigger("change"), i._refreshButtonsForTab(), i._scrollToTab(), Cookies.set("eform-quiz-tab-" + i.form_id, n, {expires: 30, path: ""})
                }
            }), this.main_tab.on("iptUIFCHide iptUIFCShow", '[role="tab"]', function () {
                i._refreshButtonsForTab()
            })) : this.on_last_page = !0
        }, applyTimerEvent: function () {
            if (void 0 !== t.fn.TimeCircles)
                if (this.settings.demoMode)
                    this.jElement.find(".ipt_fsqm_timer > .ipt_fsqm_timer_inner").text("Timer disabled in demo mode");
                else {
                    var s = this, n = this.jElement.find(".ipt_fsqm_timer_data").val();
                    if (null !== n && "" !== n && void 0 !== n && (this.timerVar = t.parseJSON(n), this.timerOuterDIV = this.jElement.find(".ipt_fsqm_timer"), this.timerDIV = this.timerOuterDIV.find("> .ipt_fsqm_timer_inner"), this.timerSpacer = this.timerOuterDIV.next(".ipt_fsqm_timer_spacer"), null !== this.timerVar && this.timerVar && (this.timerTabFormSync.timerEnabled = !0, this.timerTabFormSync.timerVar = this.timerVar, this._initTimer(), "overall" == this.timerVar.type || "page_specific" == this.timerVar.type))) {
                        var a = function () {
                            var e = t(i).scrollTop() + t(i).height(), n = s.jElement.offset().top + 10, a = n + s.jElement.outerHeight() + 90;
                            e >= n && a >= e ? s.timerOuterDIV.hasClass("fixed") || (s.timerOuterDIV.appendTo("body"), s.timerDIV.TimeCircles().rebuild(), s.timerOuterDIV.addClass("fixed")) : s.timerOuterDIV.hasClass("fixed") && (s.timerOuterDIV.insertBefore(s.timerSpacer), s.timerDIV.TimeCircles().rebuild(), s.timerOuterDIV.removeClass("fixed"))
                        };
                        t(e).on("scroll", t.debounce(250, a)), a(), t(i).on("resize iptUIFCShow iptUIFCHide tabsactivate", t.debounce(250, function () {
                            a(), s.timerDIV.TimeCircles().rebuild()
                        }))
                    }
                }
        }, _initTimer: function () {
            var i, e, s, n, a = this;
            if (this._reInitTimer(), "overall" == this.timerVar.type)
                0 === this.timerVar.time || "" === this.timerVar.time || isNaN(this.timerVar.time) ? this._destroyTimer() : (void 0 != (n = this._getPersistentTime()) ? this.timerDIV.data("timer", this._sanitizePersistentTime(n, this.timerVar.time)) : this.timerDIV.data("timer", this.timerVar.time), this.timerDIV.TimeCircles({time: {Days: {show: !1}, Hours: {text: iptPluginUIFFront.L10n.timer.Hours}, Minutes: {text: iptPluginUIFFront.L10n.timer.Minutes}, Seconds: {text: iptPluginUIFFront.L10n.timer.Seconds}}, total_duration: "Auto", count_past_zero: !1}).addListener(function (t, i, e) {
                    Cookies.set("eform-quiz-time-" + a.form_id, e, {expires: 30, path: ""}), e <= 0 && a._progressTimerPage()
                }));
            else if ("page_specific" == this.timerVar.type) {
                for (i in s = 0, this.timerVar.time)
                    e = parseFloat(this.timerVar.time[i]), isNaN(e) && (e = 0), t("#ipt_fsqm_form_" + a.form_id + "_tab_" + i).data("ipt_fsqm_timer", e), s += e;
                this.main_tab.length ? (this.block_prev_on_timer = !0, this.initialTabTimerRestore = !0, this._restoreTimerTabPosition() || (this._activeTabTimer(), a.initialTabTimerRestore = !1), this.__activeTabTimerRef = function () {
                    a._activeTabTimer(), a.initialTabTimerRestore = !1
                }, this.main_tab.on("tabsactivate", this.__activeTabTimerRef)) : 0 === s || "" === s || isNaN(s) ? this._destroyTimer() : (void 0 != (n = this._getPersistentTime()) ? this.timerDIV.data("timer", this._sanitizePersistentTime(n, s)) : this.timerDIV.data("timer", s), this.timerDIV.TimeCircles({time: {Days: {show: !1}, Hours: {text: iptPluginUIFFront.L10n.timer.Hours}, Minutes: {text: iptPluginUIFFront.L10n.timer.Minutes}, Seconds: {text: iptPluginUIFFront.L10n.timer.Seconds}}, total_duration: "Auto", count_past_zero: !1}).addListener(function (t, i, e) {
                    Cookies.set("eform-quiz-time-" + a.form_id, e, {expires: 30, path: ""}), e <= 0 && a._progressTimerPage()
                }))
            } else
                this._destroyTimer()
        }, _restoreTimerTabPosition: function () {
            var t = Cookies.get("eform-quiz-tab-" + this.form_id);
            return void 0 !== t && 0 != t && (this.changing_tab_on_timer = !0, this.main_tab.tabs("option", "active", t), this.changing_tab_on_timer = !1, !0)
        }, _getPersistentTime: function () {
            var t = Cookies.get("eform-quiz-time-" + this.form_id);
            if (void 0 != t && (t = parseInt(t, 10), !isNaN(t)))
                return t
        }, _sanitizePersistentTime: function (t, i) {
            return t <= 0 ? (this._progressTimerPage(), 0) : (t > i && (t = i), t)
        }, _activeTabTimer: function () {
            var t = this, i = this.main_tab.find(".ui-tabs-panel").eq(this.main_tab.tabs("option", "active")), e = parseFloat(i.data("ipt_fsqm_timer"));
            if (this.timerDIV.TimeCircles().destroy(), 0 === e || isNaN(e))
                this._destroyTimer(!1);
            else {
                if (this._reInitTimer(), 1 == this.initialTabTimerRestore) {
                    var s = this._getPersistentTime();
                    void 0 !== s ? this.timerDIV.data("timer", this._sanitizePersistentTime(s, e)) : this.timerDIV.data("timer", e)
                } else
                    this.timerDIV.data("timer", e);
                this.timerDIV.TimeCircles({time: {Days: {show: !1}, Hours: {text: iptPluginUIFFront.L10n.timer.Hours}, Minutes: {text: iptPluginUIFFront.L10n.timer.Minutes}, Seconds: {text: iptPluginUIFFront.L10n.timer.Seconds}}, total_duration: "Auto", count_past_zero: !1}).addListener(function (i, e, s) {
                    Cookies.set("eform-quiz-time-" + t.form_id, s, {expires: 30, path: ""}), s <= 0 && t._progressTimerPage()
                })
            }
        }, _destroyTimer: function (t) {
            if (t = void 0 !== t && t, this.timerVar) {
                this.timerDIV.hide().parent().hide().next(".ipt_fsqm_timer_spacer").hide(), this.timerTabFormSync.timerEnabled = !1, this.timerTabFormSync.forceProgress = !1, this.timerTabFormSync.forceSubmit = !1, t && this.main_tab.length && this.__activeTabTimerRef && this.main_tab.off("tabsactivate", this.__activeTabTimerRef);
                try {
                    this.timerDIV.TimeCircles().destroy()
                } catch (t) {
                }
                Cookies.remove("eform-quiz-time-" + this.form_id, {expires: 30, path: ""}), Cookies.remove("eform-quiz-tab-" + this.form_id, {expires: 30, path: ""})
            }
        }, _reInitTimer: function () {
            this.timerVar && (this.timerDIV.show().parent().show().next(".ipt_fsqm_timer_spacer").show(), this.timerTabFormSync.timerEnabled = !0, this.timerTabFormSync.forceProgress = !1, this.timerTabFormSync.forceSubmit = !1)
        }, _progressTimerPage: function () {
            if (this.timerVar)
                return!0 === this.fsqm_submitting ? (this._destroyTimer(!0), !1) : void(this.on_last_page || "overall" == this.timerVar.type ? (this.timerTabFormSync.forceProgress = !1, this.timerTabFormSync.forceSubmit = !0, this.main_form.submit(), this._destroyTimer(!0)) : (this.timerTabFormSync.forceProgress = !0, this.timerTabFormSync.forceSubmit = !1, this._navigateNextTab(), this.timerTabFormSync.forceProgress = !1))
        }, _navigateNextTab: function () {
            if (this.on_last_page)
                return!1;
            var t = this.tabIndices.index(this.tabIndices.filter('[aria-selected="true"]').next("li"));
            return-1 !== t && (this.main_tab.tabs("option", "active", t), !0)
        }, _navigatePrevTab: function () {
            if (this.on_first_page)
                return!1;
            var t = this.tabIndices.index(this.tabIndices.filter('[aria-selected="true"]').prev("li"));
            return-1 !== t && (this.main_tab.tabs("option", "active", t), !0)
        }, _onResetButton: function () {
            var t = this, i = t.jElement.find(".ipt_fsqm_form_button_container .ipt_fsqm_form_button_reset");
            i.length && i.on("click", function (i) {
                i.preventDefault(), confirm(iptFSQM.l10n.reset_confirm) && (t._restoreForm(), t.jElement.find(".ipt_fsqm_form_message_restore").hide(), t._scrollToPosition(t.jElement, 200, 10))
            })
        }, _initButtonsForTab: function () {
            var t = this;
            1 === this.tabIndices.length ? (this.prev_button.remove(), this.next_button.remove(), this.submit_button.button("enable")) : (this.prev_button.button("disable"), this.submit_button.button("disable"), this.next_button.button("enable"), this.terms_wrap.hide(), this.prev_button.on("click", function (i) {
                i.preventDefault(), t._navigatePrevTab()
            }), this.next_button.on("click", function (i) {
                i.preventDefault(), t._navigateNextTab()
            })), this._refreshButtonsForTab()
        }, _changePrevButton: function (t) {
            void 0 === t && (t = !1), !0 === this.tab_settings.block_previous || this.block_prev_on_timer ? this.prev_button.stop(!0, !0).hide() : t ? (this.prev_button.button("enable"), this.tab_settings.hidden_buttons && !this.prev_button.hasClass("iptUIFCHidden") && this.prev_button.stop(!0, !0).fadeIn("fast")) : (this.prev_button.button("disable"), this.tab_settings.hidden_buttons && !this.prev_button.hasClass("iptUIFCHidden") && this.prev_button.stop(!0, !0).hide())
        }, _changeNextButton: function (t) {
            void 0 === t && (t = !1), t ? (this.next_button.button("enable"), this.tab_settings.hidden_buttons && !this.next_button.hasClass("iptUIFCHidden") && this.next_button.stop(!0, !0).fadeIn("fast")) : (this.next_button.button("disable"), this.tab_settings.hidden_buttons && !this.next_button.hasClass("iptUIFCHidden") && this.next_button.stop(!0, !0).hide())
        }, _changeSubmitButton: function (t) {
            void 0 === t && (t = !1), t ? (this.submit_button.button("enable"), this.tab_settings.hidden_buttons && !this.submit_button.hasClass("iptUIFCHidden") && this.submit_button.stop(!0, !0).fadeIn("fast")) : (this.submit_button.button("disable"), this.tab_settings.hidden_buttons && !this.submit_button.hasClass("iptUIFCHidden") && this.submit_button.stop(!0, !0).hide())
        }, _changeTermsWrap: function (t) {
            void 0 === t && (t = !1), t ? this.terms_wrap.show() : this.terms_wrap.hide()
        }, _refreshButtonsForTab: function () {
            for (var t = this.main_tab.tabs("option", "active"), i = this.tabIndices.length, e = 0, s = i - 1;
                    this.tabIndices.eq(e).hasClass("iptUIFCHidden");
                    )
                if (++e >= i) {
                    e = i - 1;
                    break
                }
            for (;
                    this.tabIndices.eq(s).hasClass("iptUIFCHidden");
                    )
                if (--s < 0) {
                    s = i - 1;
                    break
                }
            t == s ? (t != e ? this._changePrevButton(!0) : this._changePrevButton(!1), this._changeNextButton(!1), this._changeSubmitButton(!0), this._changeTermsWrap(!0), this.on_last_page = !0, this.on_first_page = !1) : t == e ? (this._changePrevButton(!1), this._changeNextButton(!0), this._changeSubmitButton(!1), this._changeTermsWrap(!1), this.on_last_page = !1, this.on_first_page = !0) : (this._changePrevButton(!0), this._changeNextButton(!0), this._changeSubmitButton(!1), this._changeTermsWrap(!1), this.on_last_page = !1, this.on_first_page = !1)
        }, _refreshStartupTimer: function () {
            this.jElement.find(".ipt_fsqm_form_startup_timer").length && this.jElement.find(".ipt_fsqm_form_startup_timer").TimeCircles().addListener(function (t, e, s) {
                s <= 0 && i.location.reload(!0)
            })
        }, _skipTabIfNecessary: function (t, i, e) {
            this.skipping_tab_for_conditional = !0;
            var s = !1;
            if (t.newTab.hasClass("iptUIFCHidden")) {
                var n = null;
                if (i < e)
                    for (n = t.newTab.prev("li");
                            n.hasClass("iptUIFCHidden") && (n = n.prev("li")).length;
                            )
                        ;
                else
                    for (n = t.newTab.next("li");
                            n.hasClass("iptUIFCHidden") && (n = n.next("li")).length;
                            )
                        ;
                var a = this.tabIndices.index(n);
                -1 != a && this.main_tab.tabs("option", "active", a), s = !0
            }
            return this.skipping_tab_for_conditional = !1, s
        }, _restoreForm: function () {
            this.restoring_form = !0, this.main_form.trigger("reset"), this.main_form.find(".ipt_uif_slider, .ipt_uif_slider_range_max").val("0").trigger("fsqm.slider"), this.main_form.trigger("fsqm.mathematicalReEvaluate").trigger("fsqm.check_likedislike").trigger("fsqm.check_smiley"), this.main_form.find(".ipt_uif_jsignature_reset").trigger("click"), this.main_form.find(".ipt_uif_conditional").trigger("fsqm.conditional"), this.main_tab.length && this.main_tab.tabs({active: 0}), this.main_form.find(".ipt_fsqm_form_tab_pos").val("0"), void 0 !== t.fn.sayt && this.main_form.sayt({erase: !0}), this.restoring_form = !1, this.main_form.trigger("formReset.eform")
        }, _saytRestoreTab: function () {
            if (void 0 !== t.fn.sayt) {
                if (this.sayt_restoring_tab = !0, void 0 !== this.sayt_settings && !1 === this.sayt_settings.admin_override && !0 === this.sayt_settings.auto_save && !0 === this.sayt_settings.restore && !0 === this.main_form.sayt({checksaveexists: !0})) {
                    var i = this.main_form.find(".ipt_fsqm_form_tab_pos").val();
                    this.main_tab.length && void 0 !== i && this.main_tab.tabs({active: i})
                }
                this.sayt_restoring_tab = !1
            }
        }, _restoreStopwatchVal: function () {
            var t = this.jElement.find(".ipt_fsqm_form_stopwatch"), i = this.jElement.find(".ipt_fsqm_form_stopwatch_val");
            t.length && t.attr("data-timer", i.val())
        }, _endStopwatch: function (t) {
            t = void 0 !== t && t;
            var i = this.jElement.find(".ipt_fsqm_form_stopwatch");
            this.jElement.find(".ipt_fsqm_form_stopwatch_val");
            i.length && (t ? i.hide() : i.TimeCircles().destroy())
        }, _scrollToPosition: function (i, e, s) {
            var n = i.offset().top, a = this.main_form.closest(".remodal-wrapper"), r = parseFloat(t("html").css("margin-top")), o = parseFloat(t("html").css("padding-top")), _ = t("html, body");
            void 0 === s && (s = 0), void 0 === e && (e = 200), a.length ? n = i.position().top - s - 55 : (isNaN(r) && (r = 0), isNaN(o) && (o = 0), n = n - r - o, n -= s), void 0 !== this.scroll_settings && (n -= this.scroll_settings.offset), n < 0 && (n = 0), a.length && (_ = a), 0 !== e ? _.animate({scrollTop: n}, e) : _.scrollTop(n)
        }, _scrollToTab: function () {
            !1 !== this.tab_settings.scroll && (2 == this.tab_settings.type && !0 === this.tab_settings.show_progress_bar && 0 == this.tab_settings.progress_bar_bottom ? this._scrollToPosition(this.main_pb, 200, 10) : this._scrollToPosition(this.main_tab, 200, 10))
        }, _openRequiredCollapsedElements: function (i) {
            i.find(".ipt_uif_collapsible").each(function () {
                var i = !1;
                t(this).find(".check_me").each(function () {
                    if (t(this).attr("class").match(/required/))
                        return i = !0, !1
                }), i && !t(this).hasClass("ipt_uif_collapsible_open") && t(this).find(">.ipt_uif_container_head > h3 > a").trigger("click")
            })
        }, _checkUploadRequests: function (i) {
            var e = this, s = !0;
            return i.find(".ipt_uif_uploader").each(function () {
                if (!t(this).is(":visible"))
                    return!0;
                var i = t(this), n = i.data("activeUpload"), a = i.data("totalUpload"), r = i.data("settings");
                n > 0 && (i.validationEngine("showPrompt", iptFSQM.l10n.uploader_active_upload, "red"), s = !1), !0 === r.required && a < 1 && (i.validationEngine("showPrompt", iptFSQM.l10n.uploader_required, "red"), s = !1);
                var o = parseInt(r.min_number_of_files, 10);
                return(isNaN(o) || o < 0) && (o = 0), o > 1 && a < o && (i.validationEngine("showPrompt", iptFSQM.l10n.uploader_required_number + " " + o, "red"), s = !1), !1 === s ? (e._scrollToPosition(i, 200, 50), !1) : void 0
            }), s
        }, _processSubmission: function () {
            this.main_form.hide(), this.restore_block.hide(), this.success.hide(), this.http_error.hide(), this.main_form.validationEngine("hideAll"), this.main_form.iptPluginUIFFront("refreshiFrames"), this.process.show();
            var t = this.process.find(".ipt_uif_ajax_loader_inline").css("width", "auto"), i = this.process.width(), e = t.width() + 50, s = t.height();
            this.scroll_settings && 1 == this.scroll_settings.progress && this._scrollToPosition(this.process, 10, 10), t.css({width: i, height: s, opacity: 0}).animate({width: e, opacity: 1}, "normal"), this.fsqm_submitting = !0, this._endStopwatch(this.formReset && this.formReset.reset);
            var n = {action: this.main_form.find('[name="action"]').val(), ipt_ps_post: this.main_form.serialize(), ipt_ps_send_as_str: !0, ipt_ps_look_into: "ipt_ps_post"};
            this.currentPreSubmissionHooks = this.preSubmissionHooks.slice(0), this._processPreSubmissionHooks(n)
        }, _processPreSubmissionHooks: function (t) {
            this.currentPreSubmissionHooks.length ? this.currentPreSubmissionHooks.pop().callback.call(this, t) : this._ajaxFormSubmit(t)
        }, _ajaxFormSubmit: function (e) {
            var s = this;
            t.post(iptFSQM.ajaxurl, e, function (e) {
                if (null === e || 0 === e || "0" === e)
                    return s.http_error.find(".textStatus").html("Null Data"), s.http_error.find(".errorThrown").html("Possible Server Error"), s.http_error.slideDown("fast"), s.main_form.show(), void(s.scroll_settings && 1 == s.scroll_settings.message && s._scrollToPosition(s.http_error, 200, 10));
                if (!0 === e.success) {
                    if (s.success.find(".ui-widget-content.ipt_fsqm_success_wrap").html(e.msg), s.success.slideDown("fast", function () {
                        if (s.scroll_settings && 1 == s.scroll_settings.message && s._scrollToPosition(s.success, 200, 10), !0 === e.components.redirect) {
                            if ("" !== e.components.redirect_msg && (s.success.find(".ipt_fsqm_sm_meta").remove(), s.success.find(".ui-widget-content.ipt_fsqm_success_wrap").after('<div class="ui-widget-content ui-corner-all ipt_fsqm_sm_meta"><p class="ipt_fsqm_sm_meta_p">' + e.components.redirect_msg + "</p></div>")), s.success.find(".ipt_fsqm_redirection_countdown").length) {
                                var t = e.components.redirect_delay / 1e3;
                                new CountUp(s.success.find(".ipt_fsqm_redirection_countdown").get(0), t, 0, 0, t, {useEasing: !1, useGrouping: !0, separator: ",", decimal: ".", prefix: "", suffix: ""}).start()
                            }
                            setTimeout(function () {
                                i.self !== i.top && e.components.redirect_top ? i.top.location.href = e.components.redirect_url : i.location.href = e.components.redirect_url
                            }, e.components.redirect_delay)
                        }
                    }), void 0 !== s.nonce_interval && clearInterval(s.nonce_interval), s.saytIntervalID && i.clearInterval(s.saytIntervalID), void 0 !== t.fn.sayt && s.main_form.sayt({erase: !0}), s.formReset && s.formReset.reset && !0 !== e.components.redirect)
                        if (s.formReset.delay > 0)
                            new CountUp(s.success.find(".ipt_fsqm_form_reset_cu").get(0), s.formReset.delay, 0, 0, s.formReset.delay, {useEasing: !1, useGrouping: !0, separator: ",", decimal: ".", prefix: "", suffix: ""}).start(), setTimeout(function () {
                                s._resetFormOnSubmit()
                            }, 1e3 * s.formReset.delay);
                        else
                            s._resetFormOnSubmit();
                    try {
                        var n = parseInt(Cookies.get("eform-submission-" + s.form_id), 10);
                        isNaN(n) && (n = 0), Cookies.set("eform-submission-" + s.form_id, ++n, {expires: 365, path: "/"})
                    } catch (t) {
                        console && console.log && console.log(t)
                    }
                } else {
                    var a;
                    if ("object" == typeof e.errors)
                        for (a in e.errors)
                            if ("fsqm_email_limit" == e.errors[a].id || "fsqm_ip_limit" == e.errors[a].id)
                                return s.validation_block.find(".fsqm_ve_text").html(e.errors[a].msgs[0]), s.validation_block.find(".fsqm_ve_msg").html(e.errors[a].msgs[1]), s.validation_block.show(), void s.validation_block.addClass("iptAnimated iptPulseSubtle");
                    if (s.main_form.show(), "object" == typeof e.errors) {
                        var r, o, _, m, h = !1;
                        for (r = 0;
                                r < e.errors.length;
                                r++)
                            o = e.errors[r].msgs.join("<br />"), "" !== e.errors[r].id && (_ = t("#" + e.errors[r].id)).length ? (h = !0, _.validationEngine("showPrompt", o, "red"), _.closest(".ipt_uif_column_inner").css({position: "relative"})) : s.main_form.validationEngine("showPrompt", o, "red");
                        if (0 !== s.main_tab.length)
                            if (s.main_tab.find("> .ipt_fsqm_form_tab_panel").each(function () {
                                if (t(this).find(".formErrorContent").length)
                                    return m = t(this), !1
                            }), void 0 !== m && m.length) {
                                var l = s.tabIndices.index(s.tabIndices.filter('[aria-controls="' + m.attr("id") + '"]')), c = h;
                                h = !1, s.changing_tab_on_submit_error = !0, s.main_tab.tabs("option", "active", l), s.changing_tab_on_submit_error = !1, setTimeout(function () {
                                    s._scrollToPosition(m.find(".formErrorContent").eq(0), 200, 10), c && alert(iptFSQM.l10n.validation_on_submit)
                                }, 500)
                            }
                        h && alert(iptFSQM.l10n.validation_on_submit)
                    }
                }
            }, "json").fail(function (t, i, e) {
                s.http_error.find(".textStatus").html(i), s.http_error.find(".errorThrown").html(e.message), s.http_error.slideDown("fast"), s.main_form.show(), s.scroll_settings && 1 == s.scroll_settings.message && s._scrollToPosition(s.http_error, 200, 10)
            }).always(function () {
                s.process.hide(), s.fsqm_submitting = !1
            })
        }, _resetFormOnSubmit: function () {
            var t = this;
            this.timerVar && (this._destroyTimer(), this._initTimer()), this.applyNonceEvents(), this._restoreForm(), this.jElement.find(".ipt_fsqm_form_message_restore").hide(), this.sayt_settings && !0 === this.sayt_settings.interval_save && this.sayt_settings.interval > 0 && (this.saytIntervalID = i.setInterval(function () {
                t.saytManualSave()
            }, 1e3 * this.sayt_settings.interval)), this.main_form.fadeIn("fast"), this.restore_block.hide(), this.success.hide(), this.http_error.hide(), this._scrollToPosition(this.jElement, 200, 10), this.jElement.find(".ipt_fsqm_form_stopwatch_val").val(0);
            var e = this.jElement.find(".ipt_fsqm_form_stopwatch");
            e.length && (e.show(), e.TimeCircles().restart())
        }, _getElementValues: function (i, e) {
            var s, n, a, r, o = [], _ = this, m = {frown: 1, sad: 2, neutral: 3, happy: 4, excited: 5}, h = {like: 1, dislike: 0};
            switch (e) {
                case"radio":
                case"p_radio":
                    o = [], i.find("input.ipt_uif_radio").filter(":checked").each(function () {
                        o[o.length] = jQuery.trim(t(this).next("label").text())
                    });
                    break;
                case"checkbox":
                case"p_checkbox":
                    o = [], i.find("input.ipt_uif_checkbox").filter(":checked").each(function () {
                        o[o.length] = jQuery.trim(t(this).next("label").text())
                    });
                    break;
                case"select":
                case"p_select":
                    o = [], i.find("select.ipt_uif_select option").filter(":selected").each(function () {
                        o[o.length] = jQuery.trim(t(this).text())
                    });
                    break;
                case"thumbselect":
                    o = [], i.find("input.ipt_uif_radio, input.ipt_uif_checkbox").filter(":checked").each(function () {
                        o[o.length] = jQuery.trim(t(this).data("label"))
                    });
                    break;
                case"slider":
                    o = _.intelParseFloat(i.find("input.ipt_uif_slider").val());
                    break;
                case"range":
                    o = [_.intelParseFloat(i.find("input.ipt_uif_slider.slider_range").val()), _.intelParseFloat(i.find("input.ipt_uif_slider.slider_range").next("input").val())];
                    break;
                case"spinners":
                    o = [], i.find("input.ipt_uif_uispinner").each(function () {
                        "" !== t(this).val() && (o[o.length] = _.intelParseFloat(t(this).val()))
                    });
                    break;
                case"grading":
                    o = [], i.find("input.ipt_uif_slider").each(function () {
                        "" !== t(this).val() && (o[o.length] = _.intelParseFloat(t(this).val())), t(this).hasClass("slider_range") && t(this).next("input").val() && (o[o.length] = _.intelParseFloat(t(this).next("input").val()))
                    });
                    break;
                case"starrating":
                case"scalerating":
                    o = [], i.find(".ipt_uif_rating").each(function () {
                        t(this).find("input.ipt_uif_radio:checked").length && (o[o.length] = _.intelParseFloat(t(this).find("input.ipt_uif_radio:checked").val()))
                    });
                    break;
                case"matrix":
                    o = [], n = [], i.find(".ipt_uif_matrix thead th").each(function () {
                        n[n.length] = jQuery.trim(t(this).text())
                    }), i.find(".ipt_uif_checkbox,.ipt_uif_radio").filter(":checked").each(function () {
                        a = t(this).closest("tr").find("> *").index(t(this).closest("td")), "" === n[a] && void 0 === n[a] || (o[o.length] = n[a])
                    });
                    break;
                case"toggle":
                case"s_checkbox":
                    o = i.find('input[type="checkbox"]').is(":checked") ? "1" : "0";
                    break;
                case"smileyrating":
                    void 0 !== m[s = i.find('input[type="radio"]:checked').val()] && (o = m[s]);
                    break;
                case"likedislike":
                    void 0 !== h[s = i.find('input[type="radio"]:checked').val()] && (o = h[s]);
                    break;
                case"matrix_dropdown":
                    o = [], i.find("select").each(function () {
                        "" !== (r = t(this).find("option").filter(":selected")).val() && (o[o.length] = r.text())
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
                case"datetime":
                    void 0 === (o = i.find('input[type="text"]').val()) && "keypad" == e && (o = i.find("textarea").val()), _.isNumeric(o) && (o = _.intelParseFloat(o));
                    break;
                case"feedback_large":
                case"textarea":
                    o = i.find("textarea").val();
                    break;
                case"upload":
                    o = i.find(".ipt_uif_uploader").data("totalUpload");
                    break;
                case"mathematical":
                    o = _.intelParseFloat(i.find("input.ipt_uif_mathematical_input").val());
                    break;
                case"address":
                    o = [], i.find(".ipt_uif_text").each(function () {
                        o[o.length] = t(this).val()
                    });
                    break;
                default:
                    o = !1
            }
            return o
        }, _checkForReCaptcha: function () {
            return!this.reCaptchaNeeded || 0 != this.jElement.data("reCaptchaValidated") || !this.jElement.find(".g-recaptcha").is(":visible") || (this.jElement.find(".g-recaptcha").validationEngine("showPrompt", iptFSQM.l10n.recaptcha, "red"), this._scrollToPosition(this.jElement.find(".g-recaptcha")), !1)
        }, intelParseFloat: function (t, i) {
            void 0 === i && (i = 0);
            var e = parseFloat(t);
            return isNaN(e) && (e = i), e
        }, isNumeric: function (t) {
            return!isNaN(parseFloat(t)) && isFinite(t)
        }, yourOtherFunction: function () {}};
    var o = {init: function (i) {
            return this.each(function () {
                t.data(this, "plugin_" + n) || t.data(this, "plugin_" + n, new r(this, i))
            })
        }};
    t.fn[n] = function (i) {
        return o[i] ? o[i].apply(this, Array.prototype.slice.call(arguments, 1)) : ("object" != typeof i && i ? t.error("Method " + i + " does not exist on jQuery." + n) : o.init.apply(this, arguments), this)
    }
}(jQuery, window, document), jQuery(document).ready(function (t) {
    var i = !1;
    t("#eform-live-demo-mode-token").length && (i = !0), t(".ipt_fsqm_form").iptFSQMForm({demoMode: i})
});
