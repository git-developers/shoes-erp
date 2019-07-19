define(['backbone',
    'underscore',
    'dbg',
    'i18n',
    'epplayer/jquery.strobemediaplayback',
    'public/video',
    'wfed/module/dynamic/page_part_module'
], function(Backbone,
            _,
            d,
            i18n,
            PlayerEp,
            Video,
            Base) {

    return Base.extend({
        wfId: 'wfed/dynamic/imported_video',

        defaultOptions: {
            partType: 'videos'
        },

        changePage: function(page){ // called from page_composite_module on pageChanged
            this.model.set('data.page', page.attributes);
            this.render();
        }

    });
});
