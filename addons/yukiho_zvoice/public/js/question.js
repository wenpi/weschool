webpackJsonp([1], {
    0 : function(e, t, n) {
        "use strict";
        n(250);
        var i = n(22),
            a = n(2),
            s = n(6),
            r = n(50),
            o = n(230),
            l = n(5);
        l.all();
        var c = n(3).querystring,
            p = n(211),
            d = n(220),
            u = n(231),
            m = n(236),
            g = JSON.parse($("[name=pageData]").attr("content")),
            h = g.isAsker,
            y = g.isRespondent,
            f = g.isFriendsFree,
            A = g.question,
            v = g.inquiry,
            E = g.rewarders,
            b = g.visitorId,
            w = g.visitorName,
            I = g.rewarder.id,
            k = g.from_page,
            B = g.me,
            N = A.answer.free_key,
            x = g.weixin_config;
        "string" == typeof x && (x = JSON.parse(x)),
        "string" == typeof A && (A = JSON.parse(A)),
        "string" == typeof v && (v = JSON.parse(v)),
        "string" == typeof E && (E = JSON.parse(E)),
        y && N && !i.get("free_key") && !A.is_fenda_ask && "talk" !== A.type && (layer.open({
            content: '<div style="color: #3f3f3f;font-size:.75rem"><p>分享你的回答到朋友圈或微信好友，可以邀请小伙伴<strong style="font-weight:normal;color:#1CCDA6">免费</strong>来听啦~</p><p style="margin-top: 1rem;margin-bottom: .5rem">仅限回答后6小时内有效喔~</p></div>',
            btn: ["这就去分享"],
            style: "background: #fff !important;"
        }), i.set("free_key", "true", {
            expires: 30
        })),
            s.render(a.createElement(p, {
                me: B,
                visitorId: b,
                isAsker: h,
                isRespondent: y,
                inquiry: v,
                question: A,
                isFriendsFree: f,
                rewarderId: I,
                from_page: k
            }), document.getElementById("Question")),
        v && (s.render(a.createElement(d, {
            me: B,
            visitorId: b,
            isAsker: h,
            isRespondent: y,
            inquiry: v,
            question: A,
            isFriendsFree: f,
            rewarderId: I,
            from_page: k
        }), document.getElementById("Inquiry")), y && $("#content").hide());
        var R = A.status;
        if ("succeed" === R && s.render(a.createElement(u, {
                me: B,
                isAsker: h,
                isRespondent: y,
                rewarders: E,
                question: A
            }), document.getElementById("Reward")), !y || "paid" !== R && "closed" !== R ? y && v && "pending" === v.status && "inquiry" === k && s.render(a.createElement(r, {
                question_id: v.id,
                question: A,
                type: "inquiry"
            }), document.getElementById("voicePanel")) : s.render(a.createElement(r, {
                question_id: A.id,
                question: A,
                type: "question"
            }), document.getElementById("voicePanel")), y && "succeed" === R && "talk" === A.type && !A.recommendation) {
            var M = {
                empty: "你写好了啥？我咋没看见？",
                fail: "哎呀，失败，再荐 >o<"
            };
            s.render(a.createElement(m, {
                me: B,
                maxLength: 30,
                btnWidth: "7.5rem",
                btnText: "自荐一下",
                placeholder: "写个自荐语吧，告诉大家为什么值得听，提交后不能修改哦。",
                url: "/api/v1/libraries/questions/" + A.id,
                type: "put",
                prompt: M,
                paramName: "recommendation"
            }), document.getElementById("recommendation"))
        }
        x.jsApiList = ["checkJsApi", "onMenuShareTimeline", "onMenuShareAppMessage", "onMenuShareQQ", "onMenuShareWeibo", "onMenuShareQZone", "translateVoice", "startRecord", "stopRecord", "onVoiceRecordEnd", "playVoice", "onVoicePlayEnd", "pauseVoice", "stopVoice", "uploadVoice", "chooseWXPay"],
            wx.config(x);
        var Q = {
                leaderboard: "才华榜",
                questionboard: "问题榜",
                timeline: "落地页",
                singlemessage: "落地页",
                groupmessage: "落地页",
                recommend: "值得一听",
                newstar: "新晋榜",
                free: "问题榜限免",
                crowdfunding: "问题榜众筹",
                visited: "我听列表",
                feed: "收听列表",
                album_banner: "专辑列表",
                album: "专辑",
                album_next: "专辑Next"
            },
            C = Q[c("from")] || "其他",
            j = "general";
        "function" == typeof ga && (c("index") && "questionboard" === c("from") ? ga("send", "event", "toQuestion", c("index"), c("from") || "other") : ga("send", "event", "toQuestion", "click", c("from") || "other")),
        "lifeFenda" === c("from") && (l.zhuge(), window.zhuge && zhuge.track("点进问题页", {
            from: "lifefenda"
        }));
        var q, S = /iPhone|iPad|iPod/i.test(navigator.userAgent),
            T = A.respondent.nickname + "答了“" + A.content,
            _ = "值" + A.offer / 100 + "元，花1元就能偷偷听|分答，值得付费的语音问答",
            z = location.protocol + "//" + location.host + location.pathname,
            D = A.respondent.avatar,
            O = parseInt(T.replace(/[^A-Z]/gi, "").length / 3),
            J = S ? 0 : -1,
            G = S ? 0 : -2;
        if (T = (T.length > 17 + O + J ? T.slice(0, 17 + O + J) + "…": T) + "”｜分答，值得付费的语音问答", q = A.respondent.nickname + "答了“" + A.content + "”", [587467269, 590031204].indexOf(A.respondent_id) > -1 && (T = A.respondent.nickname + "答了“" + A.content, T = (T.length > 21 + O + J ? T.slice(0, 21 + O + J) + "…": T) + "”｜科普中国特邀", q = A.respondent.nickname + "答了“" + A.content + "”", _ = A.visitor_count <= 5 ? "科普中国特邀｜分答，值得付费的语音问答": "科普中国特邀，" + A.listenings_count + "人正在偷偷听｜分答，值得付费的语音问答"), N && !A.is_fenda_ask && "long_voice" !== A.type && "free_long_voice" !== A.type && (T = A.respondent.nickname + "答了“" + A.content + "”", z = z + "?free_key=" + N, T = "【好朋友免费听】" + T, q = A.respondent.nickname + "答了“" + A.content + "”", _ = "价值" + A.offer / 100 + "元，好朋友免费听|分答，值得付费的语音问答", j = "share"), A.answer && A.answer.is_free || A.is_fenda_ask) {
            var P = A.offer;
            T = A.respondent.nickname + "答了“" + A.content;
            var z = location.protocol + "//" + location.host + location.pathname;
            T = (T.length > 21 + O + J ? T.slice(0, 21 + O + J) + "…": T) + "”，价值" + P / 100 + "元，现在免费听",
                q = A.respondent.nickname + "答了“" + A.content + "”",
                _ = "价值" + P / 100 + "元，现在免费听 | 分答，值得付费的语音问答",
                j = A.is_fenda_ask ? "fenda": "free"
        }
        if (A.is_public && "succeed" === A.status || (T = A.respondent.nickname + "，" + A.respondent.title, q = A.respondent.nickname + "，" + A.respondent.title, T = (T.length > 16 + O + J ? T.slice(0, 16 + O + J) + "…": T + "，") + "等你来问|分答，值得付费的语音问答", q = (q.length > 23 + O + G ? q.slice(0, 23 + O + G) + "…": q + "，") + "等你来问", _ = "「分答」，值得付费的语音问答", z = location.protocol + "//" + location.host + "/tutor/" + A.respondent.id), "commonweal" === A.type && A.is_public && "succeed" === A.status && (T = A.respondent.nickname + "答了“" + A.content, q = A.respondent.nickname + "答了“" + A.content + "”", T = (T.length > 19 + O + J ? T.slice(0, 19 + O + J) + "…": T) + "”，捐1元听，救助先心病儿童", _ = "分答邀你参加#生命分答#公益活动，章子怡、李银河、罗振宇正在火热接力"), "talk" === A.type && "succeed" === A.status && (T = A.respondent.nickname + "正在分答讨论“" + A.content, q = A.respondent.nickname + "正在分答讨论“" + A.content + "”", _ = "十万答主正在参与 | 分答，值得付费的语音回答"), A.bonus && A.has_quota && A.is_public) {
            var Y = Math.floor(A.bonus / 100);
            T = 1 === Y ? w + "包场只请你一人听" + A.respondent.nickname + "的回答：" + A.content + "”": w + "包场请" + Y + "个好友听" + A.respondent.nickname + "的回答：" + A.content + "”",
                q = 1 === Y ? w + "包场只请你一人听" + A.respondent.nickname + "的回答：" + A.content + "”": w + "包场请" + Y + "个好友听" + A.respondent.nickname + "的回答：" + A.content + "”",
                _ = "「分答」，值得付费的语音问答",
                z = z + "?rewarder_id=" + b + "&rewarder_name=" + w + "&bonus=" + Y,
                j = "bonus"
        } else A.answer.is_liked && A.is_public && (T = w + "赞了" + A.respondent.nickname + "的回答“" + A.content + "”", q = w + "赞了" + A.respondent.nickname + "的回答“" + A.content + "”", T = (T.length > 19 + O + J ? T.slice(0, 19 + O + J) : T) + "…”|分答，值得付费的语音问答", _ = "「分答」，值得付费的语音问答", j = "support");
        "long_voice" === A.type ? _ = "超长语音，1元超值｜分答，值得付费的语音问答": "free_long_voice" === A.type && (_ = "超长语音，免费畅听｜分答，值得付费的语音问答"),
        0 !== D.indexOf("http") && (D = location.protocol + D),
            wx.ready(function() {
                wx.onMenuShareTimeline({
                    title: T,
                    link: z,
                    imgUrl: D,
                    success: function() {
                        window.zhuge && zhuge.track("分答-分享", {
                            from: C,
                            page: "问题页",
                            channel: "timeline",
                            situation: j
                        }),
                        "function" == typeof ga && ga("send", "event", "share", "question", j)
                    },
                    cancel: function() {}
                }),
                    wx.onMenuShareAppMessage({
                        title: q,
                        desc: _,
                        link: z,
                        imgUrl: D,
                        success: function() {
                            window.zhuge && zhuge.track("分答-分享", {
                                from: C,
                                page: "问题页",
                                channel: "weixin",
                                situation: j
                            }),
                            "function" == typeof ga && ga("send", "event", "share", "question", j)
                        },
                        cancel: function() {}
                    })
            }),
        window.zhuge && zhuge.track("分答-点进问题页", {
            from: C
        });
        var H = {
            getSubscribeInfo: function(e) {
                $.ajax({
                    url: "/api/v1/self/is_subscribe",
                    type: "get",
                    success: function(t) {
                        "string" == typeof t && (t = JSON.parse(t)),
                        e && e(t)
                    }
                })
            },
            follow: function(e) {
                $.ajax({
                    url: "/api/v1/accounts/" + A.respondent.id + "/follow",
                    type: "post",
                    contentType: "application/json; charset=utf-8",
                    success: function(t) {
                        e && e(t)
                    }
                })
            }
        };
        "succeed" === R ? y ? H.getSubscribeInfo(function(e) { ! e.is_subscribe && document.getElementById("code") && (document.getElementById("code").style.display = "block")
        }) : $.ajax({
            url: "/board_api/v1/boards/banner",
            data: {},
            success: function(e) {
                if ("string" == typeof e && (e = JSON.parse(e)), e.values && e.values.length > 0) {
                    var t = e.values[0];
                    t.library_id && s.render(a.createElement(o, {
                        question_id: A.id,
                        library_id: t.library_id
                    }), document.getElementById("randomQuestion"))
                }
            }.bind(void 0),
            error: function(e) {}.bind(void 0)
        }) : h && "talk" !== A.type && "long_voice" !== A.type && "free_long_voice" !== A.type && H.getSubscribeInfo(function(e) { ! e.is_subscribe && document.getElementById("code") ? document.getElementById("code").style.display = "block": s.render(a.createElement(o, {
            question_id: A.id
        }), document.getElementById("randomQuestion"))
        }),
            $("body").delegate("a.followBtn", "click",
                function(e) {
                    if (!B) return - 1 !== navigator.userAgent.toLowerCase().indexOf("micromessenger") && (location.href = login_url),
                        void $.ajax({
                            url: "/api/qrcode?url=" + encodeURIComponent(location.href),
                            success: function(e) {
                                var t = e.table ? e.table: '<img width="200" height="200" src="' + e.qrcode + '"/>';
                                layer.open({
                                    content: t + "<p>微信扫一扫，进入下一步</p>",
                                    className: "layer-wx-qrcode"
                                })
                            }
                        });
                    var t = $(this),
                        n = $('<span class="foll-btn"><i></i>已收听</span>');
                    H.follow(function(e) {
                        t.replaceWith(n)
                    })
                }),
        "commonweal" === A.type && A.library_id && ("paid" === R ? $.ajax({
            url: "/api/v1/libraries/" + A.library_id,
            data: {},
            success: function(e) {
                if ("string" == typeof e && (e = JSON.parse(e)), e.activity && e.activity.length > 0) {
                    var t = e.activity[0],
                        n = t.description_in_answer,
                        i = a.createElement("a", {
                                href: "/lifefenda"
                            },
                            a.createElement("div", {
                                    style: {
                                        padding: ".75rem 2rem .75rem .75rem",
                                        fontSize: ".65rem",
                                        lineHeight: ".98rem",
                                        background: "#fff",
                                        boxSizing: "border-box",
                                        backgroundImage: 'url("http://hangjia.qiniudn.com/FghQkJgO80xIKLa15-rhz_Y9dpI7")',
                                        backgroundSize: ".325rem .655rem",
                                        backgroundPosition: "center right .75rem",
                                        backgroundRepeat: "no-repeat"
                                    }
                                },
                                a.createElement("p", {
                                        style: {
                                            color: "#999 !important"
                                        }
                                    },
                                    n), a.createElement("p", {
                                        style: {
                                            color: "#F85F48 !important"
                                        }
                                    },
                                    "戳我了解活动详情 >")));
                    s.render(i, document.getElementById("content"))
                }
            }.bind(void 0),
            error: function(e) {}.bind(void 0)
        }) : "succeed" === R && $.ajax({
            url: "/api/v1/libraries/" + A.library_id,
            data: {},
            success: function(e) {
                if ("string" == typeof e && (e = JSON.parse(e)), e.activity && e.activity.length > 0) {
                    var t = e.activity[0],
                        n = t.description_in_question,
                        i = e.visitors_count,
                        r = e.bonuses,
                        o = +i + Math.round( + r / 100 * 100 / 100),
                        l = (parseInt(o / 2e4), "目前已累计捐赠 ￥" + o + "。"),
                        c = a.createElement("a", {
                                href: "/lifefenda"
                            },
                            a.createElement("div", {
                                    style: {
                                        padding: ".75rem 2rem .75rem .75rem",
                                        fontSize: ".65rem",
                                        lineHeight: ".98rem",
                                        background: "#fff",
                                        boxSizing: "border-box",
                                        backgroundImage: 'url("http://hangjia.qiniudn.com/FghQkJgO80xIKLa15-rhz_Y9dpI7")',
                                        backgroundSize: ".325rem .655rem",
                                        backgroundPosition: "center right .75rem",
                                        backgroundRepeat: "no-repeat"
                                    }
                                },
                                a.createElement("p", {
                                        style: {
                                            color: "#999 !important"
                                        }
                                    },
                                    n + l), a.createElement("p", {
                                        style: {
                                            color: "#F85F48 !important"
                                        }
                                    },
                                    "戳我了解活动详情 >")));
                    s.render(c, document.getElementById("content"))
                }
            }.bind(void 0),
            error: function(e) {}.bind(void 0)
        })),
        "talk" === A.type && A.library_id && $.ajax({
            url: "/api/v1/talks/" + A.library_id,
            data: {},
            success: function(e) {
                "string" == typeof e && (e = JSON.parse(e));
                var t = "";
                if ("paid" === R && e.guide ? t = e.guide: "succeed" === R && e.description && (t = e.description), t) {
                    var n = a.createElement("a", {
                            href: "/talk/" + A.library_id
                        },
                        a.createElement("div", {
                                style: {
                                    padding: ".75rem 2rem .75rem .75rem",
                                    fontSize: ".65rem",
                                    lineHeight: ".98rem",
                                    background: "#fff",
                                    boxSizing: "border-box",
                                    backgroundImage: 'url("http://hangjia.qiniudn.com/FghQkJgO80xIKLa15-rhz_Y9dpI7")',
                                    backgroundSize: ".325rem .655rem",
                                    backgroundPosition: "center right .75rem",
                                    backgroundRepeat: "no-repeat"
                                }
                            },
                            a.createElement("p", {
                                    style: {
                                        color: "#999 !important"
                                    }
                                },
                                t)));
                    s.render(n, document.getElementById("content"))
                }
            }.bind(void 0),
            error: function(e) {}.bind(void 0)
        }),
        ["long_voice", "free_long_voice"].indexOf(A.type) > -1 && "succeed" === R && $.ajax({
            url: "/board_api/v1/boards/long_voice",
            type: "get",
            contentType: "application/json; charset=utf-8",
            success: function(e) {
                "string" == typeof e && (e = JSON.parse(e));
                var t = e.values;
                "long_voice" === A.type ? t && t.map(function(e) {
                    e.is_free || $.ajax({
                        url: "/api/v1/albums/" + e.id,
                        type: "get",
                        contentType: "application/json; charset=utf-8",
                        success: function(e) {
                            var t = a.createElement("div", {
                                    className: "tutor-card"
                                },
                                a.createElement("a", {
                                        href: "/album/" + e.id,
                                        className: "tutor-content"
                                    },
                                    a.createElement("h3", {
                                            className: "tutor-name"
                                        },
                                        e.title, a.createElement("span", {
                                                style: {
                                                    marginLeft: ".3rem",
                                                    color: "#999"
                                                }
                                            },
                                            "合辑")), a.createElement("p", {
                                            className: "tutor-title"
                                        },
                                        "查看其它", e.items_count - 1, "条长语音")));
                            s.render(t, document.getElementById("content"))
                        },
                        error: function(e) {},
                        dataType: "json"
                    })
                }) : t && t.map(function(e) {
                    e.is_free && $.ajax({
                        url: "/api/v1/albums/" + e.id,
                        type: "get",
                        contentType: "application/json; charset=utf-8",
                        success: function(e) {
                            var t = a.createElement("div", {
                                    className: "tutor-card"
                                },
                                a.createElement("a", {
                                        href: "/album/" + e.id,
                                        className: "tutor-content"
                                    },
                                    a.createElement("h3", {
                                            className: "tutor-name"
                                        },
                                        e.title, a.createElement("span", {
                                                style: {
                                                    marginLeft: ".3rem",
                                                    color: "#999"
                                                }
                                            },
                                            "合辑")), a.createElement("p", {
                                            className: "tutor-title"
                                        },
                                        "查看其它", e.items_count - 1, "条长语音")));
                            s.render(t, document.getElementById("content"))
                        },
                        error: function(e) {},
                        dataType: "json"
                    })
                })
            },
            error: function(e) {},
            dataType: "json"
        }),
            $("body").delegate("#openQuestion", "click",
                function() {
                    s.render(a.createElement(p, {
                        me: B,
                        visitorId: b,
                        isAsker: h,
                        isRespondent: y,
                        inquiry: v,
                        question: A,
                        isFriendsFree: f,
                        rewarderId: I,
                        from_page: "question"
                    }), document.getElementById("Question")),
                        s.render(a.createElement(d, {
                            me: B,
                            visitorId: b,
                            isAsker: h,
                            isRespondent: y,
                            inquiry: v,
                            question: A,
                            isFriendsFree: f,
                            rewarderId: I,
                            from_page: "question"
                        }), document.getElementById("Inquiry")),
                        s.render(a.createElement("span", null), document.getElementById("voicePanel"))
                }),
            $("body").delegate("#openInquiry", "click",
                function() {
                    s.render(a.createElement(p, {
                        me: B,
                        visitorId: b,
                        isAsker: h,
                        isRespondent: y,
                        inquiry: v,
                        question: A,
                        isFriendsFree: f,
                        rewarderId: I,
                        from_page: "inquiry"
                    }), document.getElementById("Question")),
                        s.render(a.createElement(d, {
                            me: B,
                            visitorId: b,
                            isAsker: h,
                            isRespondent: y,
                            inquiry: v,
                            question: A,
                            isFriendsFree: f,
                            rewarderId: I,
                            from_page: "inquiry"
                        }), document.getElementById("Inquiry")),
                        s.render(a.createElement(r, {
                            question_id: v.id,
                            question: A,
                            type: "inquiry"
                        }), document.getElementById("voicePanel"))
                })
    },
    50 : function(e, t, n) {
        "use strict";
        var i = n(2),
            a = n(9);
        n(3),
            n(22),
            window.free_key = null;
        
        e.exports = s
    },
    211 : function(e, t, n) {
        "use strict";
        var i = n(2),
            a = n(1),
            s = n(10),
            r = (n(9), n(3)),
            o = n(6),
            l = n(50),
            c = {
                leaderboard: "才华榜",
                questionboard: "问题榜",
                timeline: "落地页",
                singlemessage: "落地页",
                groupmessage: "落地页",
                recommend: "值得一听",
                newstar: "新晋榜",
                free: "问题榜限免",
                crowdfunding: "问题榜众筹",
                visited: "我听列表",
                feed: "收听列表",
                album_banner: "专辑列表",
                album: "专辑",
                album_next: "专辑Next"
            },
            p = c[r.querystring("from")] || "其他",
            d = !1;
        a.locale("zh-cn", {
            relativeTime: function(e, t, n, i) {
                var a = {
                        s: "几秒",
                        m: "1分钟",
                        mm: e + "分钟",
                        h: "1小时",
                        hh: e + "小时",
                        d: "1天",
                        dd: e + "天",
                        M: "1个月",
                        MM: e + "个月",
                        y: "1年",
                        yy: e + "年"
                    },
                    s = a[n];
                return i ? s += "内": "s" == n || "m" == n ? s = "刚刚": s += "前",
                    s
            }
        });
        var u = i.createClass({
            displayName: "AQ",
            getInitialState: function() {
                return {
                    is_liked: this.props.question.answer.is_liked,
                    likings_count: this.props.question.answer.likings_count,
                    listenings_count: this.props.question.listenings_count,
                    play: !1,
                    is_weixin: -1 !== navigator.userAgent.toLowerCase().indexOf("micromessenger"),
                    voice: this.props.question.answer.voice,
                    isRerecording: !1,
                    isRevoking: !1
                }
            },
            _liked: function(e) {
                if (e.preventDefault(), !this.props.me) return e.preventDefault(),
                this.state.is_weixin && (location.href = login_url),
                    void $.ajax({
                        url: "/api/qrcode?url=" + encodeURIComponent(location.href),
                        success: function(e) {
                            var t = e.table ? e.table: '<img width="200" height="200" src="' + e.qrcode + '"/>';
                            layer.open({
                                content: t + "<p>微信扫一扫，进入下一步</p>",
                                className: "layer-wx-qrcode"
                            })
                        }
                    });
                var t = this.props.question,
                    n = t.answer,
                    i = this.state.voice;
                return this.state.is_liked ? !1 : ("string" == typeof n && (n = JSON.parse(n)), void(i ? (n.is_free || this.props.isAsker || this.props.isRespondent || "talk" !== t.type || $.ajax({
                    url: "/api/v1/questions/" + t.id + "/visit",
                    type: "post",
                    async: !1,
                    data: JSON.stringify({
                        source: "talk"
                    }),
                    contentType: "application/json; charset=utf-8",
                    success: function(e) {},
                    error: function(e) {},
                    dataType: "json"
                }), $.ajax({
                    url: "/api/v1/answers/" + n.id + "/vote",
                    data: JSON.stringify({
                        opinion: "support"
                    }),
                    type: "post",
                    contentType: "application/json; charset=utf-8",
                    success: function(e) {
                        this.setState({
                            is_liked: !0,
                            likings_count: this.state.likings_count + 1
                        }),
                        window.zhuge && zhuge.track("点赞")
                    }.bind(this),
                    error: function(e) {
                        var t = e.responseText,
                            n = JSON.parse(t).text;
                        n ? layer.open({
                            content: n,
                            time: 2
                        }) : layer.open({
                            content: "出了点错误，请稍后尝试",
                            time: 2
                        })
                    }
                })) : layer.open({
                    content: "偷偷听之后才能点哦",
                    time: 2
                })))
            },
            _handleListen: function(e) {
                if (e.preventDefault(), !this.props.me) return e.preventDefault(),
                this.state.is_weixin && (location.href = login_url),
                    void $.ajax({
                        url: "/api/qrcode?url=" + encodeURIComponent(location.href),
                        success: function(e) {
                            var t = e.table ? e.table: '<img width="200" height="200" src="' + e.qrcode + '"/>';
                            layer.open({
                                content: t + "<p>微信扫一扫，进入下一步</p>",
                                className: "layer-wx-qrcode"
                            })
                        }
                    });
                if (!this.state.play) {
                    var t = this.refs.voice.value.trim(),
                        n = this.props.question.id;
                    if (this.props.visitorId, "nothing" === t) window.zhuge && zhuge.track("分答-偷偷听", {
                        from: p,
                        page: "问题页"
                    }),
                    "function" == typeof ga && ("long_voice" === this.props.question.type || "free_long_voice" === this.props.question.type ? ga("send", "event", "visit", "click", "longTest") : ga("send", "event", "visit", "click")),
                        layer.open({
                            content: "「分答」正在用力请求微信支付",
                            shadeClose: !1
                        }),
                        "qrcode" === r.querystring("pay_type") ? this._qrcode_pay() : this._sdk_pay();
                    else {
                        var i = document.getElementById("inquiryPlayer");
                        i && i.pause();
                        var a = this.props.rewarderId ? "bonus": this.props.isFriendsFree ? "share": this.props.question.is_fenda_ask ? "fenda": "visit";
                        "talk" === this.props.question.type && (a = "talk"),
                        "free_long_voice" === this.props.question.type && (a = "fenda");
                        var s = {
                            source: a
                        };
                        if (this.props.rewarderId && (s.rewarder_id = this.props.rewarderId), !this.props.question.answer.is_free && !this.props.isAsker && !this.props.isRespondent) {
                            var o = this;
                            $.ajax({
                                url: "/api/v1/questions/" + n + "/visit",
                                type: "post",
                                data: JSON.stringify(s),
                                contentType: "application/json; charset=utf-8",
                                success: function(e) {
                                    "talk" === o.props.question.type && o.setState({
                                        listenings_count: o.state.listenings_count + 1
                                    })
                                },
                                error: function(e) {},
                                dataType: "json"
                            })
                        }
                        if ("function" == typeof ga) switch (r.querystring("from")) {
                            case "free":
                                ga("send", "event", "visitFree", "limit1", n);
                                break;
                            case "talk":
                                ga("send", "event", "visitFree", "limit2", n);
                                break;
                            case "longTest":
                                ga("send", "event", "visitFree", "longTest", n);
                                break;
                            case "fendaask":
                                ga("send", "event", "visitFree", "otherFree", n)
                        }
                        this.refs.player.src = t,
                            this.refs.player.play(),
                            this.setState({
                                play: !0
                            })
                    }
                }
            },
            _sdk_pay: function() {
                var e = this,
                    t = this.props.question.id;
                $.ajax({
                    url: "/api/v1/questions/" + t + "/pay",
                    type: "post",
                    data: JSON.stringify({
                        trade_type: "JSAPI",
                        order_type: "visit"
                    }),
                    contentType: "application/json; charset=utf-8",
                    success: function(t) {
                        var n = t.prepay_id;
                        $.ajax({
                            url: "/api/pay",
                            type: "post",
                            data: JSON.stringify({
                                prepay_id: n,
                                nonceStr: t.nonce_str
                            }),
                            contentType: "application/json; charset=utf-8",
                            success: function(t) {
                                layer.closeAll(),
                                    t.success = function(t) {
                                        window.zhuge && zhuge.track("分答-偷偷听成功", {
                                            from: p,
                                            page: "问题页"
                                        }),
                                        "function" == typeof ga && ("long_voice" === e.props.question.type || "free_long_voice" === e.props.question.type ? ga("send", "event", "visit", "paid", "longTest") : ga("send", "event", "visit", "paid", r.querystring("from") || "other"));
                                        var n = r.removeParameter("rewarder_id");
                                        n = r.removeParameter("rewarder_name", n),
                                            n = r.removeParameter("free_key", n),
                                        window._smq && "function" == typeof _smq.push && _smq.push(["custom", "分答支付", "支付完成收听页面", "点击播放"]),
                                            setTimeout(function() {
                                                    location.replace(n)
                                                },
                                                500)
                                    },
                                    t.fail = function() {
                                        e._qrcode_pay()
                                    },
                                    wx.chooseWXPay(t)
                            },
                            dataType: "json"
                        })
                    },
                    error: function(e) {
                        var t = e.responseText,
                            n = JSON.parse(t).error_code;
                        if ("already_paid" === n) {
                            layer.open({
                                content: "您已付过款了，请稍等，让答案飞一会儿",
                                time: 2
                            });
                            var i = r.removeParameter("rewarder_id");
                            i = r.removeParameter("rewarder_name", i),
                                i = r.removeParameter("free_key", i),
                                setTimeout(function() {
                                        location.replace(i)
                                    },
                                    2e3)
                        } else layer.open({
                            content: "出了点错误，请稍后尝试",
                            time: 2
                        })
                    },
                    dataType: "json"
                })
            },
            qr_pay_timer: null,
            _qrcode_pay: function() {
                var e = this,
                    t = this.props.question.id;
                $.ajax({
                    url: "/api/v1/questions/" + t + "/pay",
                    type: "post",
                    data: JSON.stringify({
                        trade_type: "NATIVE",
                        order_type: "visit"
                    }),
                    contentType: "application/json; charset=utf-8",
                    success: function(n) {
                        var i = n.code_url;
                        i ? $.ajax({
                            url: "/api/qr_code_pay",
                            type: "post",
                            data: JSON.stringify({
                                code_url: i
                            }),
                            contentType: "application/json; charset=utf-8",
                            success: function(n) {
                                layer.open({
                                    title: [""],
                                    content: '<div class="layer-wx-pay"><p class="layer-tip">长按二维码支付</p>' + n.qrcode + "</div>",
                                    shadeClose: !1,
                                    style: "border:none;box-shadow:none",
                                    cancel: function() {
                                        e.qr_pay_timer && clearInterval(e.qr_pay_timer)
                                    }
                                }),
                                    e.qr_pay_timer = setInterval(function() {
                                            $.ajax({
                                                url: "/api/v1/questions/" + t,
                                                success: function(e) {
                                                    if (e.answer.voice) {
                                                        var t = r.removeParameter("rewarder_id");
                                                        t = r.removeParameter("rewarder_name", t),
                                                            t = r.removeParameter("free_key", t),
                                                            location.replace(t)
                                                    }
                                                }
                                            })
                                        },
                                        1e3)
                            },
                            error: function(e) {
                                layer.open({
                                    content: '<div class="layer-wx-pay">请求微信支付失败，刷新页面试试</div>',
                                    time: 2
                                })
                            }
                        }) : layer.open({
                            content: '<div class="layer-wx-pay">请求微信支付失败，刷新页面试试</div>',
                            time: 2
                        })
                    },
                    error: function(e) {
                        var t = e.responseText,
                            n = JSON.parse(t).error_code;
                        if ("already_paid" === n) {
                            layer.open({
                                content: "您已付过款了，请稍等，让答案飞一会儿",
                                time: 2
                            });
                            var i = r.removeParameter("rewarder_id");
                            i = r.removeParameter("rewarder_name", i),
                                i = r.removeParameter("free_key", i),
                                setTimeout(function() {
                                        location.replace(i)
                                    },
                                    2e3)
                        } else layer.open({
                            content: "出了点错误，请稍后尝试",
                            time: 2
                        })
                    },
                    dataType: "json"
                })
            },
            tika: 0,
            _handlePlaying: function(e) {
                if (!this.props.question.is_fenda_ask) {
                    this.refs.w1.style.display = "none",
                        this.refs.w2.style.display = "none";
                    var t = setInterval(function() {
                        this.tika += 1,
                            this.tika % 3 === 0 ? (this.refs.w1.style.display = "none", this.refs.w2.style.display = "none") : this.tika % 3 === 1 ? (this.refs.w1.style.display = "block", this.refs.w2.style.display = "none") : (this.refs.w1.style.display = "block", this.refs.w2.style.display = "block")
                    }.bind(this), 500);
                    this.setState({
                        timer: t
                    })
                }
                this.refs.tip.innerHTML = ""
            },
            _handlePause: function(e) {
                this._stop(e)
            },
            _handleEnded: function(e) {
                this._stop(e)
            },
            _stop: function(e) {
                this.state.timer && clearInterval(this.state.timer),
                this.refs.w1 && this.refs.w2 && (this.refs.w1.style.display = "block", this.refs.w2.style.display = "block"),
                    this.refs.tip.innerHTML = "点击播放",
                    this.tika = 0,
                    this.setState({
                        timer: null,
                        play: !1
                    })
            },
            _refuse: function(e) {
                var t = this.props.question.id;
                layer.open({
                    content: '<p style="font-size:.85rem;line-height:1.2rem;margin:.2rem 0;">确定不回答这个问题？</p>	                        <textarea placeholder="填写拒绝理由，最多30字，非必填" style="border: 1px solid #d6d6d6;border-radius: .2rem;margin-top:.725rem;width:100%;resize:none;background:#fafafa;box-sizing:border-box;padding:.5rem;font-size:.75rem;line-height:1rem;font-weight:lighter;box-shadow:none;outline:none;-webkit-appearance:none;" rows="4" id="refuseReason" maxlength="30"></textarea>',
                    btn: ['<font style="color:#f85f48;">确定</font>', "我再想想"],
                    style: "background: #fff !important; width: 100%;",
                    yes: function() {
                        if (!d) {
                            d = !0;
                            var e = document.getElementById("refuseReason").value.trim() || "",
                                n = {};
                            e && (n.content = e),
                                $.ajax({
                                    url: "/api/v1/questions/" + t + "/refused",
                                    type: "put",
                                    data: JSON.stringify(n),
                                    contentType: "application/json; charset=utf-8",
                                    success: function(e) {
                                        window.location.href = "/me/answer"
                                    },
                                    error: function(e) {
                                        d = !1,
                                            layer.open({
                                                content: "<p>网络遇到了一点问题，只能忍痛再拒绝一次了</p>",
                                                time: 2
                                            })
                                    }
                                })
                        }
                    }
                })
            },
            _revoke: function() {
                var e = this,
                    t = this.props.question.id;
                layer.open({
                    className: "yes-no-layer",
                    content: "<p>提问后1分钟内可撤回<br/>每天只有一次撤回机会哦～<br/>确定要撤回么？</p>",
                    btn: ["确定", "再想想"],
                    yes: function() {
                        e.state.isRevoking || (e.setState({
                            isRevoking: !0
                        }), $.ajax({
                            url: "/api/v1/questions/" + t + "/revoke",
                            type: "put",
                            data: JSON.stringify({}),
                            contentType: "application/json; charset=utf-8",
                            success: function(e) {
                                window.location.href = "/me/ask"
                            },
                            error: function(t) {
                                e.setState({
                                    isRevoking: !1
                                });
                                var n = t.responseText,
                                    i = JSON.parse(n).text || "网络遇到了一点问题，刷新试试~";
                                layer.open({
                                    content: i,
                                    time: 2
                                }),
                                    setTimeout(function() {
                                            location.reload(!0)
                                        },
                                        2e3)
                            }
                        }))
                    }
                })
            },
            _reRecord: function() {
                var e = this;
                this.state.isRerecording || layer.open({
                    className: "yes-no-layer",
                    content: "<p>回答后1小时内，<br/>可重新录制一条语音，替换现有回答</p>",
                    btn: ["重答", "不用了"],
                    yes: function() {
                        e.setState({
                            isRerecording: !0
                        }),
                            layer.closeAll();
                        var t = e.props.inquiry ? "inquiry": "question";
                        o.render(i.createElement(l, {
                            question_id: e.props.question.id,
                            question: e.props.question,
                            isRerecording: e.state.isRerecording,
                            type: t
                        }), document.getElementById("voicePanel")),
                            o.render(i.createElement("div", null), document.getElementById("content")),
                            o.render(i.createElement("div", null), document.getElementById("Reward"))
                    }
                })
            },
            _inquiry: function() {
                var e = !1,
                    t = this.props.question,
                    n = t.respondent,
                    i = t.is_public,
                    a = i ? "公开问题公开追问": "私密问题私密追问";
                layer.open({
                    title: " ",
                    className: "layer-inquiry",
                    content: '<textarea placeholder="向' + n.nickname + "提问，等Ta语音回答；" + a + '" rows="6" maxlength="60" id="inquiryContent"></textarea>',
                    btn: ["免费追问"],
                    style: "width: 100%;",
                    yes: function() {
                        if (e) {
                            e = !1,
                                s.style.background = "#d6d6d6";
                            var n = $.trim($("#inquiryContent").val()),
                                i = {
                                    content: n,
                                    type: "text"
                                };
                            $.ajax({
                                url: "/api/v1/questions/" + t.id + "/discussions",
                                type: "post",
                                data: JSON.stringify(i),
                                contentType: "application/json; charset=utf-8",
                                success: function(e) {
                                    window.location.reload()
                                },
                                error: function(t) {
                                    var n = t.responseText,
                                        i = JSON.parse(n).error_code;
                                    "discussion_is_spam" === i ? layer.open({
                                        content: "<p>您的问题涉及敏感词，建议修改后提交</p>",
                                        time: 2
                                    }) : layer.open({
                                        content: "<p>网络遇到了一点问题，只能忍痛再拒绝一次了</p>",
                                        time: 2
                                    }),
                                        e = !0,
                                        s.style.background = "#f85f48"
                                }
                            })
                        }
                    }
                });
                var s = $(".layermbtn span")[0];
                $("#inquiryContent").on("input",
                    function() {
                        var t = $(this),
                            n = $.trim(t.val()).length;
                        n > 0 ? (e = !0, s.style.background = "#f85f48") : (e = !1, s.style.background = "#d6d6d6")
                    })
            },
            _handleOpenTip: function() {
                layer.open({
                    title: "计费说明",
                    content: '<p>1）偷偷听：<br/>	                    1元偷偷听分成收入由提问者和答主平分。</p>	                    <p>2）赞赏：<br/>	                    用户在某条回答下赞赏答主后，可以根据赞赏金额，按照比例邀请好友免费听这条回答。每赞赏1元即可邀请一位好友免费听。 赞赏收入全部归答主，不与提问者分成。</p>	                    <p>3）免费听 ：<br/>	                    所有免费听的问题都不产生偷偷听分成收入，包括但不限于：答主回答问题后邀请好友免费听、赞赏后邀请好友免费听、分答提问免费听。 </p>	                    <p style="margin-top: 1rem;">所有收入扣除10%为收益，每夜自动入库微信钱包。',
                    btn: ["知道了"],
                    className: "agreement-layer",
                    closeBtn: 0
                })
            },
            render: function() {
                var e = this.props.question,
                    t = e.respondent,
                    n = e.answer,
                    r = e.asker,
                    o = e.is_fenda_ask,
                    l = this.props.isRespondent,
                    c = this.props.isAsker;
                if ("string" == typeof e.asker) var r = JSON.parse(e.asker);
                if ("string" == typeof e.respondent) var t = JSON.parse(e.respondent);
                if ("string" == typeof e.answer) var n = JSON.parse(e.answer);
                var p = 587467300 == r.id ? "初露锋芒": r.nickname + "问所有人",
                    d = i.createElement("span", null);
                "commonweal" == e.type && e.library_id || (d = (c || l) && ("closed" === e.status || "succeed" === e.status && "recover" === e.type) ? i.createElement("span", {
                        className: "question-price"
                    },
                    i.createElement("i", {
                            className: "old-price"
                        },
                        "￥", e.offer / 100), " ￥0") : i.createElement("span", {
                        className: "question-price"
                    },
                    o ? p: "talk" !== e.type ? "￥" + e.offer / 100 : ""));
                var u = "";
                l ? u = "paid" !== e.status && "closed" !== e.status ? e.is_public ? "succeed" === e.status ? "": i.createElement("i", {
                        className: "is-public-tag public"
                    },
                    "公开") : i.createElement("i", {
                        className: "is-public-tag private"
                    },
                    "私密") : "": c && (u = e.is_public ? "succeed" === e.status ? "": i.createElement("i", {
                        className: "is-public-tag public"
                    },
                    "公开") : i.createElement("i", {
                        className: "is-public-tag private"
                    },
                    "私密"));
                var m, g = i.createElement("div", {
                        className: "question"
                    },
                    ["long_voice", "free_long_voice"].indexOf(e.type) < 0 ? i.createElement("div", {
                            className: "question-title"
                        },
                        i.createElement("a", {
                                href: "/tutor/" + r.id
                            },
                            i.createElement(s, {
                                size: 1.25,
                                avatar: r.avatar,
                                is_verified: r.is_verified
                            })), i.createElement("span", {
                                className: "question-name"
                            },
                            r.nickname), d) : null, i.createElement("div", null, i.createElement("p", {
                            className: "question-content"
                        },
                        u, e.content))),
                    h = "";
                this.state.voice || (m = this.props.question.has_quota ? "点击播放": "commonweal" === e.type ? "捐1元听": "1元偷偷听"),
                    m = o || ["talk", "free_long_voice"].indexOf(e.type) > -1 ? "免费畅听": n.is_free ? "限时免费听": this.props.isFriendsFree ? "好朋友免费听": l || c ? "点击播放": m,
                this.state.voice && (m = "点击播放");
                var y = this.state.voice && o ? i.createElement("span", {
                        className: this.state.play ? "gift gift-swing": "gift"
                    }) : i.createElement("div", null, i.createElement("span", {
                        className: "wave1"
                    }), i.createElement("span", {
                        className: "wave2",
                        ref: "w1"
                    }), i.createElement("span", {
                        className: "wave3",
                        ref: "w2"
                    })),
                    f = n.duration > 60 ? 60 : n.duration,
                    A = ["long_voice", "free_long_voice"].indexOf(e.type) < 0 ? i.createElement("span", {
                            className: "duration"
                        },
                        n.duration > 60 ? 60 : n.duration, '"') : i.createElement("span", {
                            className: "duration",
                            style: {
                                color: "#1CCDA6"
                            }
                        },
                        parseInt(n.duration / 60), "分", parseInt(n.duration % 60), "秒"),
                    v = l && n.is_enable_reanswer && ["long_voice", "free_long_voice"].indexOf(e.type) < 0 ? i.createElement("span", {
                            className: "re-record-btn",
                            onClick: this._reRecord
                        },
                        "重答") : i.createElement("span", null),
                    E = this.props.isAsker && e.is_enable_inquiry && "talk" !== e.type ? i.createElement("span", {
                            className: "re-record-btn",
                            onClick: this._inquiry
                        },
                        "追问") : i.createElement("span", null),
                    b = i.createElement("div", {
                            className: "answer"
                        },
                        i.createElement("a", {
                                href: "/tutor/" + t.id,
                                className: "avatar-wrap"
                            },
                            i.createElement(s, {
                                size: 1.85,
                                avatar: t.avatar,
                                is_verified: t.is_verified
                            })), i.createElement("input", {
                            type: "hidden",
                            value: this.state.voice ? this.state.voice: "nothing",
                            ref: "voice"
                        }), i.createElement("a", {
                                className: n.is_free ? "bubble bubble-red": "bubble",
                                style: {
                                    width: f * (10.5 / 58) + "rem"
                                },
                                onClick: this._handleListen,
                                href: "javascript:;"
                            },
                            i.createElement("span", {
                                className: "bubble-tail"
                            }), y, i.createElement("span", {
                                    ref: "tip"
                                },
                                m)), A, v, E, h),
                    w = i.createElement("span", {
                            className: "count",
                            onClick: this._liked
                        },
                        i.createElement("i", {
                            className: this.state.is_liked ? "like-icon like-icon-red": "like-icon like-icon-gray"
                        }), " ", this.state.likings_count),
                    I = n.is_reanswered ? a(e.date_updated).fromNow(!0) + "更新": a(e.date_updated).fromNow(!0);
                if ("paid" === e.status && l && !o && "talk" !== e.type) {
                    var k = new Date;
                    k = k.getTime();
                    var B = new Date(e.date_updated);
                    B = B.getTime(),
                        I = "还有" + (48 - Math.floor((k - B) / 36e5)) + "小时过期"
                }
                var N = i.createElement("span", null);
                "paid" === e.status && (l && !o && "talk" !== e.type && (N = i.createElement("a", {
                        onClick: this._refuse,
                        className: "action-btn",
                        href: "javascript:;"
                    },
                    "拒绝回答")), c && e.is_enable_revoke && "talk" !== e.type && (N = i.createElement("a", {
                        onClick: this._revoke,
                        className: "action-btn",
                        href: "javascript:;"
                    },
                    "撤回")));
                var x = "closed" === e.status ? i.createElement("span", {
                        className: "tip"
                    },
                    l ? "48小时内未回答，已过期退款": "已过期") : "revoked" === e.status ? i.createElement("span", {
                        className: "tip"
                    },
                    l ? "提问已撤回": "已撤回") : "",
                    R = l || "long_voice" !== e.type && "free_long_voice" !== e.type ? "": i.createElement("div", {
                            style: {
                                color: "#999",
                                marginTop: ".6rem",
                                fontSize: ".65rem"
                            }
                        },
                        t.nickname, "｜", t.title),
                    M = "succeed" === e.status ? i.createElement("div", {
                            className: "footer"
                        },
                        w, i.createElement("span", {
                                className: "count"
                            },
                            "听过 ", this.state.listenings_count), i.createElement("span", {
                                className: "date"
                            },
                            I)) : i.createElement("div", {
                            className: "footer"
                        },
                        i.createElement("span", {
                                className: "date"
                            },
                            I), N, x);
                "commonweal" === e.type && "paid" === e.status && (M = i.createElement("div", {
                    style: {
                        height: ".5rem"
                    }
                })),
                "commonweal" === e.type && "succeed" === e.status && (M = i.createElement("div", {
                        className: "footer",
                        style: {
                            paddingTop: "0"
                        }
                    },
                    w, i.createElement("span", {
                            className: "count"
                        },
                        "已捐 ¥", +e.visitor_count + Math.round( + e.bonuses / 100 * 100 / 100)), i.createElement("span", {
                            className: "date"
                        },
                        I)));
                var Q, C = "commonweal" === e.type || "talk" === e.type ? i.createElement("div", {
                        className: "title"
                    },
                    i.createElement("span", null, t.nickname), "｜", i.createElement("span", null, t.title)) : i.createElement("span", null),
                    j = "talk" === e.type && e.recommendation ? i.createElement("div", {
                            className: "recommend"
                        },
                        "自荐语：", e.recommendation) : i.createElement("span", null),
                    q = (l || c) && "succeed" === e.status && e.visitor_count && "commonweal" !== e.type && !o ? i.createElement("div", {
                            className: "listen-count-tip"
                        },
                        "其中偷偷听", e.visitor_count, "  分成收入", i.createElement("span", {
                                className: "highlight"
                            },
                            "￥", e.visitor_count / 2), i.createElement("i", {
                            className: "read-me",
                            onClick: this._handleOpenTip
                        })) : i.createElement("div", {
                        style: {
                            margin: "0 -.6rem",
                            borderTop: "1px solid #e5e5e5"
                        }
                    }),
                    S = i.createElement("a", {
                        className: "toggle-btn",
                        id: "openQuestion",
                        href: "javascript:;"
                    });
                return Q = "succeed" === this.props.question.status ? "inquiry" === this.props.from_page && this.props.isRespondent && this.props.inquiry && "pending" === this.props.inquiry.status ? i.createElement("li", {
                        className: "aq"
                    },
                    g, S, i.createElement("div", {
                        style: {
                            margin: "0 -.6rem",
                            borderTop: "1px solid #e5e5e5"
                        }
                    })) : i.createElement("li", {
                        className: "aq"
                    },
                    g, b, C, R, j, M, q, i.createElement("audio", {
                        style: {
                            display: "none"
                        },
                        onPause: this._handlePause,
                        onEnded: this._handleEnded,
                        onPlaying: this._handlePlaying,
                        id: "questionPlayer",
                        preload: "preload",
                        ref: "player",
                        src: ""
                    })) : i.createElement("li", {
                        className: "aq"
                    },
                    g, M, q)
            }
        });
        e.exports = u
    },
    220 : function(e, t, n) {
        "use strict";
        var i = n(2),
            a = n(1),
            s = n(10),
            r = n(3);
        n(6),
            n(50),
            a.locale("zh-cn", {
                relativeTime: function(e, t, n, i) {
                    var a = {
                            s: "几秒",
                            m: "1分钟",
                            mm: e + "分钟",
                            h: "1小时",
                            hh: e + "小时",
                            d: "1天",
                            dd: e + "天",
                            M: "1个月",
                            MM: e + "个月",
                            y: "1年",
                            yy: e + "年"
                        },
                        s = a[n];
                    return i ? s += "内": "s" == n || "m" == n ? s = "刚刚": s += "前",
                        s
                }
            });
        var o = i.createClass({
            displayName: "Inquiry",
            getInitialState: function() {
                return {
                    play: !1,
                    is_weixin: -1 !== navigator.userAgent.toLowerCase().indexOf("micromessenger"),
                    voice: this.props.inquiry.answer.voice,
                    isRerecording: !1
                }
            },
            _handleListen: function(e) {
                if (e.preventDefault(), !this.props.me) return e.preventDefault(),
                this.state.is_weixin && (location.href = login_url),
                    void $.ajax({
                        url: "/api/qrcode?url=" + encodeURIComponent(location.href),
                        success: function(e) {
                            var t = e.table ? e.table: '<img width="200" height="200" src="' + e.qrcode + '"/>';
                            layer.open({
                                content: t + "<p>微信扫一扫，进入下一步</p>",
                                className: "layer-wx-qrcode"
                            })
                        }
                    });
                if (!this.state.play) {
                    var t = this.refs.voice.value.trim(),
                        n = this.props.question.id;
                    if (this.props.visitorId, "nothing" === t)"function" == typeof ga && ga("send", "event", "visit", "click"),
                        layer.open({
                            content: "「分答」正在用力请求微信支付",
                            shadeClose: !1
                        }),
                        "qrcode" === r.querystring("pay_type") ? this._qrcode_pay() : this._sdk_pay();
                    else {
                        var i = document.getElementById("questionPlayer");
                        i && i.pause();
                        var a = this.props.rewarderId ? "bonus": this.props.isFriendsFree ? "share": this.props.question.is_fenda_ask ? "fenda": "visit",
                            s = {
                                source: a
                            };
                        this.props.rewarderId && (s.rewarder_id = this.props.rewarderId),
                        this.props.question.answer.is_free || this.props.isAsker || this.props.isRespondent || $.ajax({
                            url: "/api/v1/questions/" + n + "/visit",
                            type: "post",
                            data: JSON.stringify(s),
                            contentType: "application/json; charset=utf-8",
                            success: function(e) {},
                            error: function(e) {},
                            dataType: "json"
                        }),
                        "free" === r.querystring("from") && "function" == typeof ga && ga("send", "event", "visitFree", "click", n),
                            this.refs.player.src = t,
                            this.refs.player.play(),
                            this.setState({
                                play: !0
                            })
                    }
                }
            },
            _sdk_pay: function() {
                var e = this,
                    t = this.props.question.id;
                $.ajax({
                    url: "/api/v1/questions/" + t + "/pay",
                    type: "post",
                    data: JSON.stringify({
                        trade_type: "JSAPI",
                        order_type: "visit"
                    }),
                    contentType: "application/json; charset=utf-8",
                    success: function(t) {
                        var n = t.prepay_id;
                        $.ajax({
                            url: "/api/pay",
                            type: "post",
                            data: JSON.stringify({
                                prepay_id: n,
                                nonceStr: t.nonce_str
                            }),
                            contentType: "application/json; charset=utf-8",
                            success: function(t) {
                                layer.closeAll(),
                                    t.success = function(e) {
                                        "function" == typeof ga && ga("send", "event", "visit", "paid", r.querystring("from") || "other");
                                        var t = r.removeParameter("rewarder_id");
                                        t = r.removeParameter("rewarder_name", t),
                                        window._smq && "function" == typeof _smq.push && _smq.push(["custom", "分答支付", "支付完成收听页面", "点击播放"]),
                                            setTimeout(function() {
                                                    location.replace(t)
                                                },
                                                500)
                                    },
                                    t.fail = function() {
                                        e._qrcode_pay()
                                    },
                                    wx.chooseWXPay(t)
                            },
                            dataType: "json"
                        })
                    },
                    error: function(e) {
                        var t = e.responseText,
                            n = JSON.parse(t).error_code;
                        if ("already_paid" === n) {
                            layer.open({
                                content: "您已付过款了，请稍等，让答案飞一会儿",
                                time: 2
                            });
                            var i = r.removeParameter("rewarder_id");
                            i = r.removeParameter("rewarder_name", i),
                                setTimeout(function() {
                                        location.replace(i)
                                    },
                                    2e3)
                        } else layer.open({
                            content: "出了点错误，请稍后尝试",
                            time: 2
                        })
                    },
                    dataType: "json"
                })
            },
            qr_pay_timer: null,
            _qrcode_pay: function() {
                var e = this,
                    t = this.props.question.id;
                $.ajax({
                    url: "/api/v1/questions/" + t + "/pay",
                    type: "post",
                    data: JSON.stringify({
                        trade_type: "NATIVE",
                        order_type: "visit"
                    }),
                    contentType: "application/json; charset=utf-8",
                    success: function(n) {
                        var i = n.code_url;
                        i ? $.ajax({
                            url: "/api/qr_code_pay",
                            type: "post",
                            data: JSON.stringify({
                                code_url: i
                            }),
                            contentType: "application/json; charset=utf-8",
                            success: function(n) {
                                layer.open({
                                    title: [""],
                                    content: '<div class="layer-wx-pay"><p class="layer-tip">长按二维码支付</p>' + n.qrcode + "</div>",
                                    shadeClose: !1,
                                    style: "border:none;box-shadow:none",
                                    cancel: function() {
                                        e.qr_pay_timer && clearInterval(e.qr_pay_timer)
                                    }
                                }),
                                    e.qr_pay_timer = setInterval(function() {
                                            $.ajax({
                                                url: "/api/v1/questions/" + t,
                                                success: function(e) {
                                                    if (e.answer.voice) {
                                                        var t = r.removeParameter("rewarder_id");
                                                        t = r.removeParameter("rewarder_name", t),
                                                            location.replace(t)
                                                    }
                                                }
                                            })
                                        },
                                        1e3)
                            },
                            error: function(e) {
                                layer.open({
                                    content: '<div class="layer-wx-pay">请求微信支付失败，刷新页面试试</div>',
                                    time: 2
                                })
                            }
                        }) : layer.open({
                            content: '<div class="layer-wx-pay">请求微信支付失败，刷新页面试试</div>',
                            time: 2
                        })
                    },
                    error: function(e) {
                        var t = e.responseText,
                            n = JSON.parse(t).error_code;
                        if ("already_paid" === n) {
                            layer.open({
                                content: "您已付过款了，请稍等，让答案飞一会儿",
                                time: 2
                            });
                            var i = r.removeParameter("rewarder_id");
                            i = r.removeParameter("rewarder_name", i),
                                setTimeout(function() {
                                        location.replace(i)
                                    },
                                    2e3)
                        } else layer.open({
                            content: "出了点错误，请稍后尝试",
                            time: 2
                        })
                    },
                    dataType: "json"
                })
            },
            tika: 0,
            _handlePlaying: function(e) {
                if (!this.props.question.is_fenda_ask) {
                    this.refs.w1.style.display = "none",
                        this.refs.w2.style.display = "none";
                    var t = setInterval(function() {
                        this.tika += 1,
                            this.tika % 3 === 0 ? (this.refs.w1.style.display = "none", this.refs.w2.style.display = "none") : this.tika % 3 === 1 ? (this.refs.w1.style.display = "block", this.refs.w2.style.display = "none") : (this.refs.w1.style.display = "block", this.refs.w2.style.display = "block")
                    }.bind(this), 500);
                    this.setState({
                        timer: t
                    })
                }
                this.refs.tip.innerHTML = ""
            },
            _handlePause: function(e) {
                this._stop(e)
            },
            _handleEnded: function(e) {
                this._stop(e)
            },
            _stop: function(e) {
                this.state.timer && clearInterval(this.state.timer),
                this.refs.w1 && this.refs.w2 && (this.refs.w1.style.display = "block", this.refs.w2.style.display = "block"),
                    this.refs.tip.innerHTML = "点击播放",
                    this.tika = 0,
                    this.setState({
                        timer: null,
                        play: !1
                    })
            },
            render: function() {
                var e = this.props.question,
                    t = this.props.inquiry,
                    n = e.respondent,
                    r = e.answer,
                    o = t.answer,
                    l = e.asker,
                    c = e.is_fenda_ask,
                    p = this.props.isRespondent,
                    d = this.props.isAsker;
                "string" == typeof e.asker && (l = JSON.parse(e.asker)),
                "string" == typeof e.respondent && (n = JSON.parse(e.respondent)),
                "string" == typeof e.answer && (r = JSON.parse(e.answer)),
                "string" == typeof t.answer && (o = JSON.parse(t.answer));
                var u = "";
                p ? u = "paid" !== e.status ? e.is_public ? "succeed" === e.status ? "": i.createElement("i", {
                        className: "is-public-tag public"
                    },
                    "公开") : i.createElement("i", {
                        className: "is-public-tag private"
                    },
                    "私密") : "": d && (u = e.is_public ? "succeed" === e.status ? "": i.createElement("i", {
                        className: "is-public-tag public"
                    },
                    "公开") : i.createElement("i", {
                        className: "is-public-tag private"
                    },
                    "私密"));
                var m, g = i.createElement("div", {
                        className: "question"
                    },
                    i.createElement("div", {
                            className: "inguiry-title"
                        },
                        i.createElement("span", {
                                className: "tips"
                            },
                            d || p ? "免费追问": "追问")), i.createElement("div", null, i.createElement("p", {
                            className: "question-content"
                        },
                        u, t.content))),
                    h = "";
                this.state.voice || (m = this.props.question.has_quota ? "点击播放": ("commonweal" === e.type, "追问附赠听")),
                    m = c || "talk" === e.type ? "免费畅听": r.is_free ? "限时免费听": this.props.isFriendsFree ? "好朋友免费听": p || d ? "点击播放": m,
                this.state.voice && (m = "点击播放");
                var y, f = this.state.voice && c ? i.createElement("span", {
                        className: this.state.play ? "gift gift-swing": "gift"
                    }) : i.createElement("div", null, i.createElement("span", {
                        className: "wave1"
                    }), i.createElement("span", {
                        className: "wave2",
                        ref: "w1"
                    }), i.createElement("span", {
                        className: "wave3",
                        ref: "w2"
                    })),
                    A = o.duration > 60 ? 60 : o.duration,
                    v = i.createElement("div", {
                            className: "answer"
                        },
                        i.createElement("div", {
                                className: "avatar-wrap"
                            },
                            i.createElement(s, {
                                size: 1.85,
                                avatar: n.avatar,
                                is_verified: n.is_verified
                            })), i.createElement("input", {
                            type: "hidden",
                            value: this.state.voice ? this.state.voice: "nothing",
                            ref: "voice"
                        }), i.createElement("a", {
                                className: r.is_free ? "bubble bubble-red": "bubble",
                                style: {
                                    width: A * (10.5 / 58) + "rem"
                                },
                                onClick: this._handleListen,
                                href: "javascript:;"
                            },
                            i.createElement("span", {
                                className: "bubble-tail"
                            }), f, i.createElement("span", {
                                    ref: "tip"
                                },
                                m)), i.createElement("span", {
                                className: "duration"
                            },
                            A, '"'), h),
                    E = "pending" === t.status && "question" === this.props.from_page && this.props.isRespondent ? i.createElement("a", {
                            className: "answer-btn",
                            id: "openInquiry",
                            href: "javascript:;"
                        },
                        "去回答") : i.createElement("span", null),
                    b = i.createElement("div", {
                            className: "footer",
                            style: {
                                marginTop: ".525rem"
                            }
                        },
                        i.createElement("span", {
                                className: "date"
                            },
                            a(t.date_updated).fromNow(!0)), E);
                return y = "succeed" === this.props.inquiry.status ? i.createElement("li", {
                        className: "aq",
                        style: {
                            paddingTop: ".625rem",
                            marginBottom: ".5rem"
                        }
                    },
                    g, v, b, i.createElement("audio", {
                        style: {
                            display: "none"
                        },
                        onPause: this._handlePause,
                        onEnded: this._handleEnded,
                        onPlaying: this._handlePlaying,
                        id: "inquiryPlayer",
                        preload: "preload",
                        ref: "player",
                        src: ""
                    })) : d || p ? i.createElement("li", {
                        className: "aq",
                        style: {
                            paddingTop: ".625rem",
                            marginBottom: ".5rem"
                        }
                    },
                    g, b) : i.createElement("span", null)
            }
        });
        e.exports = o
    },
    230 : function(e, t, n) {
        "use strict";
        var i = n(2),
            a = n(1),
            s = n(3).querystring;
        a.locale("zh-cn", {
            relativeTime: function(e, t, n, i) {
                var a = {
                        s: "几秒",
                        m: "1分钟",
                        mm: e + "分钟",
                        h: "1小时",
                        hh: e + "小时",
                        d: "1天",
                        dd: e + "天",
                        M: "1个月",
                        MM: e + "个月",
                        y: "1年",
                        yy: e + "年"
                    },
                    s = a[n];
                return i ? s += "内": "s" == n || "m" == n ? s = "刚刚": s += "前",
                    s
            }
        });
        var r = s("albumid"),
            o = s("from") || "empty",
            l = {
                album: "next",
                album_next: "next",
                lifeFenda: "life_fenda",
                empty: "random"
            },
            c = l[o],
            p = i.createClass({
                displayName: "Random",
                getStyle: function() {
                    return {
                        root: {
                            marginTop: "1.5rem",
                            marginBottom: "4rem"
                        },
                        title: {
                            color: "#999",
                            fontSize: ".8rem",
                            padding: ".9rem .6rem",
                            fontWeight: "normal",
                            paddingBottom: ".2rem"
                        },
                        card: {
                            background: "#fff",
                            paddingRight: "1.325rem",
                            position: "relative"
                        },
                        question: {
                            color: "#3f3f3f",
                            fontSize: ".75rem",
                            marginBottom: ".4rem"
                        },
                        leader: {
                            color: "#999",
                            fontSize: ".65rem",
                            marginBottom: ".2rem"
                        },
                        footer: {
                            color: "#999",
                            fontSize: ".65rem"
                        }
                    }
                },
                getInitialState: function() {
                    return {
                        question: {}
                    }
                },
                _load: function() {
                    var e = "",
                        t = {
                            question_id: this.props.question_id
                        };
                    "next" == c ? (e = "/api/v1/questions/next", t.target = r, t.target_type = "album") : (e = "/api/v1/questions/random", "life_fenda" == c && (t.library_id = this.props.library_id)),
                        $.ajax({
                            url: e,
                            data: t,
                            success: function(e) {
                                this.setState({
                                    question: e
                                })
                            }.bind(this),
                            error: function(e) {}
                        })
                },
                componentDidMount: function() {
                    this._load()
                },
                render: function() {
                    var e = this.getStyle();
                    if (this.state.question.content) {
                        var t = "next" == c ? "/question/" + this.state.question.id + "?from=album_next&albumid=" + r: "life_fenda" == c ? "/question/" + this.state.question.id + "?from=lifeFenda": "/question/" + this.state.question.id + "?from=recommend";
                        return i.createElement("div", {
                                style: e.root
                            },
                            i.createElement("h3", {
                                    style: e.title
                                },
                                "next" == c ? "下一个来自 " + this.state.question.source: "值得一听"), i.createElement("a", {
                                    style: {
                                        display: "block",
                                        padding: ".9rem .6rem",
                                        textDecoration: "none",
                                        background: "#fff",
                                        position: "relative"
                                    },
                                    href: t
                                },
                                i.createElement("div", {
                                        style: e.card
                                    },
                                    i.createElement("p", {
                                            style: e.question
                                        },
                                        this.state.question.content), i.createElement("p", {
                                            style: e.leader
                                        },
                                        i.createElement("span", null, this.state.question.respondent.nickname, "｜", this.state.question.respondent.title)), i.createElement("p", {
                                            style: e.footer
                                        },
                                        i.createElement("span", null, a(this.state.question.date_created).fromNow(!0) + "回答"), i.createElement("span", {
                                                style: {
                                                    marginLeft: "1.5rem"
                                                }
                                            },
                                            this.state.question.listenings_count, "人听过")), i.createElement("p", {
                                        style: {
                                            display: "block",
                                            width: "100%",
                                            height: "100%",
                                            position: "absolute",
                                            left: "0",
                                            top: "0",
                                            textDecoration: "none",
                                            backgroundImage: "url(http://hangjia.qiniudn.com/FghQkJgO80xIKLa15-rhz_Y9dpI7)",
                                            backgroundSize: ".325rem .65rem",
                                            backgroundPosition: "center right",
                                            backgroundRepeat: "no-repeat"
                                        }
                                    }))))
                    }
                    return i.createElement("div", null)
                }
            });
        e.exports = p
    },
    231 : function(e, t, n) {
        "use strict";
        var i = n(2),
            a = n(3),
            s = i.createClass({
                displayName: "Reward",
                getInitialState: function() {
                    return {
                        rewarders: [],
                        rewarders_count: 0,
                        is_weixin: -1 !== navigator.userAgent.toLowerCase().indexOf("micromessenger")
                    }
                },
                _load: function() {
                    $.ajax({
                        url: "/api/v1/questions/" + this.props.question.id + "/rewarder",
                        data: {},
                        success: function(e, t, n) {
                            var i = e.length;
                            "function" == typeof n.getResponseHeader && (i = n.getResponseHeader("total-count") || e.length),
                                i = parseInt(i),
                                this.setState({
                                    rewarders: e,
                                    rewarders_count: i
                                })
                        }.bind(this)
                    })
                },
                componentDidMount: function() {
                    this._load()
                },
                _handleClick: function(e) {
                    var t = this.props.question;
                    if (!this.props.me) return e.preventDefault(),
                    this.state.is_weixin && (location.href = login_url),
                        void $.ajax({
                            url: "/api/qrcode?url=" + encodeURIComponent(location.href),
                            success: function(e) {
                                var t = e.table ? e.table: '<img width="200" height="200" src="' + e.qrcode + '"/>';
                                layer.open({
                                    content: t + "<p>微信扫一扫，进入下一步</p>",
                                    className: "layer-wx-qrcode"
                                })
                            }
                        });
                    if ("function" == typeof ga && ga("send", "event", "bonus", "click"), t.answer.voice) {
                        t.answer.is_free || this.props.isAsker || this.props.isRespondent || "talk" !== t.type || $.ajax({
                            url: "/api/v1/questions/" + t.id + "/visit",
                            type: "post",
                            async: !1,
                            data: JSON.stringify({
                                source: "talk"
                            }),
                            contentType: "application/json; charset=utf-8",
                            success: function(e) {},
                            error: function(e) {},
                            dataType: "json"
                        });
                        var n = null,
                            i = t.is_public ? '<p class="describe">每赞赏N元，可请N个朋友免费听<br/><span>（赞赏收入归答主）</span></p>': '<p class="describe">赞赏收入归答主</p>';
                        layer.open({
                            title: " ",
                            className: "reward-layer",
                            content: i + '<div>	                            <span class="priceItem price-item" data-value="2"><b>2 </b>元</span>	                            <span class="priceItem price-item" data-value="5"><b>5 </b>元</span>	                            <span class="priceItem price-item" data-value="10"><b>10 </b>元</span>	                        </div>	                        <label class="other-price">任性赞赏 <input id="price" placeholder="1-20000" type="text" /> 元</label>	                        <p class="error"></p>',
                            btn: ["支付"],
                            yes: function() {
                                if (n) {
                                    if (isNaN(n)) return void $(".error").text("价格要填数字哦");
                                    if (n = 1e3 * n / 10, n > 2e6) return void $(".error").text("价格不能大于20000哦");
                                    if (100 > n) return void $(".error").text("价格不能小于1哦");
                                    layer.open({
                                        content: "「分答」正在用力请求微信支付",
                                        shadeClose: !1
                                    }),
                                        $.ajax({
                                            url: "/api/v1/questions/" + t.id + "/pay",
                                            type: "post",
                                            data: JSON.stringify({
                                                trade_type: "JSAPI",
                                                order_type: "bonus",
                                                bonus: n
                                            }),
                                            contentType: "application/json; charset=utf-8",
                                            success: function(e) {
                                                var t = e.prepay_id;
                                                $.ajax({
                                                    url: "/api/pay",
                                                    type: "post",
                                                    data: JSON.stringify({
                                                        prepay_id: t,
                                                        nonceStr: e.nonce_str
                                                    }),
                                                    contentType: "application/json; charset=utf-8",
                                                    success: function(e) {
                                                        layer.closeAll();
                                                        var t = a.removeParameter("rewarder_id");
                                                        t = a.removeParameter("rewarder_name", t),
                                                            e.success = function(e) {
                                                                location.replace(t)
                                                            },
                                                            wx.chooseWXPay(e),
                                                        window.zhuge && zhuge.track("赞赏成功", {
                                                            offer: n
                                                        }),
                                                        "function" == typeof ga && ga("send", "event", "bonus", "paid")
                                                    },
                                                    dataType: "json"
                                                })
                                            },
                                            error: function(e) {
                                                var t = e.responseText,
                                                    n = JSON.parse(t).text;
                                                n ? layer.open({
                                                    content: n,
                                                    time: 2
                                                }) : layer.open({
                                                    content: "出了点错误，请稍后尝试",
                                                    time: 2
                                                })
                                            },
                                            dataType: "json"
                                        })
                                }
                            },
                            closeBtn: 2
                        });
                        var s = $(".layermbtn span")[0];
                        $(".priceItem").on("click",
                            function() {
                                var e = $(this);
                                e.hasClass("active") || (e.addClass("active").siblings(".priceItem").removeClass("active"), $("#price").val(""), s.style.background = "#f85f48", n = e.attr("data-value"))
                            }),
                            $("#price").on("input",
                                function() {
                                    var e = $(this);
                                    e.val().trim() && ($(".active").length ? $(".active").removeClass("active") : s.style.background = "#f85f48", n = e.val().trim()),
                                    e.val().trim() || $(".active").length || (s.style.background = "#d6d6d6", n = "")
                                }),
                        window.zhuge && zhuge.track("点击赞赏按钮", {
                            status: "succeed"
                        })
                    } else layer.open({
                        content: "还没听就赞赏，<br/>你是有钱任性吗？",
                        time: 2
                    }),
                    window.zhuge && zhuge.track("点击赞赏按钮", {
                        status: "failed"
                    })
                },
                render: function() {
                    var e = (this.props.question, this.props.isRespondent ? "": i.createElement("button", {
                            className: "reward-btn",
                            onClick: this._handleClick
                        },
                        "赞赏")),
                        t = this.props.isRespondent && this.props.question.bonuses && "commonweal" !== this.props.question.type ? i.createElement("p", {
                                className: "bonuses"
                            },
                            "赞赏收入", i.createElement("span", {
                                    className: "highlight"
                                },
                                "￥", this.props.question.bonuses / 100)) : "",
                        n = this,
                        a = this.state.rewarders.length;
                    return this.state.rewarders_count ? i.createElement("div", {
                            className: "reward",
                            style: {
                                background: "white"
                            }
                        },
                        e, n.state.rewarders.map(function(e, t) {
                            return i.createElement("a", {
                                    key: t,
                                    href: e.id ? "/tutor/" + e.id: "javascript:;"
                                },
                                e.nickname, a - 1 > t ? "，": "")
                        }), this.state.rewarders_count > 10 ? "等": " ", this.state.rewarders_count, "人赞赏", t) : e ? i.createElement("div", {
                            className: "reward"
                        },
                        e) : i.createElement("span", null)
                }
            });
        e.exports = s
    },
    236 : function(e, t, n) {
        "use strict";
        var i = n(2),
            a = (n(3), n(9)),
            s = i.createClass({
                displayName: "TextForm",
                getInitialState: function() {
                    return {
                        is_weixin: -1 !== navigator.userAgent.toLowerCase().indexOf("micromessenger"),
                        maxLength: this.props.maxLength || 30,
                        contentLength: 0,
                        btnWidth: this.props.btnWidth || "7.5rem",
                        btnText: this.props.btnText || "确定",
                        placeholder: this.props.placeholder || "",
                        sending: !1,
                        url: this.props.url,
                        type: this.props.type || "put",
                        paramName: this.props.paramName,
                        prompt: this.props.prompt || {
                            empty: "不能为空",
                            fail: "出了点错误，请稍后重试"
                        }
                    }
                },
                _handleFocus: function(e) {
                    return this.props.me ? void 0 : (e.preventDefault(), this.state.is_weixin && (location.href = login_url), e.target.blur(), void $.ajax({
                        url: "/api/qrcode?url=" + encodeURIComponent(location.href),
                        success: function(e) {
                            var t = e.table ? e.table: '<img width="200" height="200" src="' + e.qrcode + '"/>';
                            layer.open({
                                content: t + "<p>微信扫一扫，进入下一步</p>",
                                className: "layer-wx-qrcode"
                            })
                        }
                    }))
                },
                _handleInput: function(e) {
                    var t = e.target.value.trim();
                    this.setState({
                        contentLength: t.length
                    })
                },
                _handleSubmit: function(e) {
                    if (e.preventDefault(), !this.props.me) return this.state.is_weixin && (location.href = login_url),
                        void $.ajax({
                            url: "/api/qrcode?url=" + encodeURIComponent(location.href),
                            success: function(e) {
                                var t = e.table ? e.table: '<img width="200" height="200" src="' + e.qrcode + '"/>';
                                layer.open({
                                    content: t + "<p>微信扫一扫，进入下一步</p>",
                                    className: "layer-wx-qrcode"
                                })
                            }
                        });
                    var t = this.refs.content.value.trim();
                    return t.length < 1 ? void layer.open({
                        content: this.state.prompt.empty,
                        time: 2
                    }) : t.length > this.props.maxLength ? void layer.open({
                        content: "最多" + this.state.maxLength + "字哦",
                        time: 2
                    }) : void this.setState({
                            sending: !0
                        },
                        function() {
                            var e = {};
                            e[this.state.paramName] = t,
                                $.ajax({
                                    url: this.state.url,
                                    type: this.state.type,
                                    data: e,
                                    success: function(e) {
                                        window.location.reload()
                                    }.bind(this),
                                    error: function(e) {
                                        layer.open({
                                            content: this.state.prompt.fail,
                                            time: 2
                                        }),
                                            this.setState({
                                                sending: !1
                                            })
                                    }.bind(this)
                                })
                        })
                },
                render: function() {
                    return i.createElement("form", {
                            className: "text-form",
                            onSubmit: this._handleSubmit
                        },
                        i.createElement("div", {
                                className: "text-wrap"
                            },
                            i.createElement("textarea", {
                                ref: "content",
                                onFocus: this._handleFocus,
                                onChange: this._handleInput,
                                maxLength: this.state.maxLength,
                                placeholder: this.state.placeholder
                            }), i.createElement("span", {
                                    className: "counter"
                                },
                                this.state.contentLength, "/", this.state.maxLength)), i.createElement("div", {
                                className: "btn-panel"
                            },
                            i.createElement(a, {
                                type: "submit",
                                status: "primary",
                                width: this.state.btnWidth,
                                text: this.state.btnText
                            })))
                }
            });
        e.exports = s
    },
    250 : function(e, t) {}
});