/**
 * AdminLTE Demo Menu
 * ------------------
 * You should not use this file in production.
 * This file is for demo purposes only.
 */
(function ($, AdminLTE) {

  "use strict";

  /**
   * List of all the available skins
   *
   * @type Array
   */
  var my_skins = [
    "skin-blue",
    "skin-black",
    "skin-red",
    "skin-yellow",
    "skin-purple",
    "skin-green",
    "skin-blue-light",
    "skin-black-light",
    "skin-red-light",
    "skin-yellow-light",
    "skin-purple-light",
    "skin-green-light"
  ];

  //Create the new tab
  var tab_pane = $("<div />", {
    "id": "control-sidebar-theme-demo-options-tab",
    "class": "tab-pane active"
  });

  //Create the tab button
  var tab_button = $("<li />", {"class": "active"})
      .html("<a href='#control-sidebar-theme-demo-options-tab' data-toggle='tab'>"
      + "SETTINGS &nbsp;<i class='fa fa-wrench'></i>"
      + "</a>");

  //Add the tab button to the right sidebar tabs
  $("[href='#control-sidebar-home-tab']")
      .parent()
      .before(tab_button);

  //Create the menu
  var demo_settings = $("<div />");

  //Layout options
  demo_settings.append(
      "<center><h4 style='font-family:verdana;font-size:11px;color:#181f23;' class='control-sidebar-heading bg-warning'>"
      + "<strong><span class='fa fa-file-o'></span>&nbsp;ALL REPORTS</strong>"
      + "</h4></center>"
        //Fixed layout
      + "<a href='reports/statement_of_cylinder/dr_cylinder_per_customer'><div class='form-group'>"
      + "<label class='control-sidebar-subheading' style='font-size:11px;font-family:verdana;'>"
      + "<strong>Statement of Cylinders</strong>"
      + "</label>"
      + "<p style='font-size:11px;font-family:verdana;color:whitesmoke;'>Cylinder(s) that is/are Still in the hand of Customer XYZ</p>"
      + "</div></a>"
        + "<a href=''><div class='form-group'>"
      + "<label class='control-sidebar-subheading' style='font-size:11px;font-family:verdana;'>"
      + "<strong>Statement of Cylinders</strong>"
      + "</label>"
      + "<p style='font-size:11px;font-family:verdana;color:whitesmoke;'>All Overdue Cylinders per Customer</p>"
      + "</div></a>"
        + "<a href=''><div class='form-group'>"
      + "<label class='control-sidebar-subheading' style='font-size:11px;font-family:verdana;'>"
      + "<strong>Customer Aging Report</strong>"
      + "</label>"
      + "<p style='font-size:11px;font-family:verdana;color:whitesmoke;'>Aging Report</p>"
      + "</div></a>"
      +"<center><h4 style='font-family:verdana;font-size:11px;color:#181f23;' class='control-sidebar-heading bg-warning'>"
      + "<strong><span class='fa fa-trash'></span>&nbsp;RECYCLE BIN</strong>"
      + "</h4></center>"
        //Fixed layout
      + "<a href=''><div class='form-group'>"
      + "<label class='control-sidebar-subheading' style='font-size:11px;font-family:verdana;'>"
      + "<strong>Statement of Cylinders</strong>"
      + "</label>"
      + "<p style='font-size:11px;font-family:verdana;color:whitesmoke;'>Cylinder(s) that is/are Still in the hand of Customer XYZ</p>"
      + "</div></a>"
        + "<a href=''><div class='form-group'>"
      + "<label class='control-sidebar-subheading' style='font-size:11px;font-family:verdana;'>"
      + "<strong>Statement of Cylinders</strong>"
      + "</label>"
      + "<p style='font-size:11px;font-family:verdana;color:whitesmoke;'>All Overdue Cylinders per Customer</p>"
      + "</div></a>"
        + "<a href=''><div class='form-group'>"
      + "<label class='control-sidebar-subheading' style='font-size:11px;font-family:verdana;'>"
      + "<strong>Customer Aging Report</strong>"
      + "</label>"
      + "<p style='font-size:11px;font-family:verdana;color:whitesmoke;'>Aging Report</p>"
      + "</div></a>"
      
  );
  var skins_list = $("<ul />", {"class": 'list-unstyled clearfix'});

  //Dark sidebar skins
  
  demo_settings.append(skins_list);

  tab_pane.append(demo_settings);
  $("#control-sidebar-home-tab").after(tab_pane);

  setup();

  /**
   * Toggles layout classes
   *
   * @param String cls the layout class to toggle
   * @returns void
   */
  function change_layout(cls) {
    $("body").toggleClass(cls);
    AdminLTE.layout.fixSidebar();
    //Fix the problem with right sidebar and layout boxed
    if (cls == "layout-boxed")
      AdminLTE.controlSidebar._fix($(".control-sidebar-bg"));
    if ($('body').hasClass('fixed') && cls == 'fixed') {
      AdminLTE.pushMenu.expandOnHover();
      AdminLTE.layout.activate();
    }
    AdminLTE.controlSidebar._fix($(".control-sidebar-bg"));
    AdminLTE.controlSidebar._fix($(".control-sidebar"));
  }

  /**
   * Replaces the old skin with the new skin
   * @param String cls the new skin class
   * @returns Boolean false to prevent link's default action
   */
  function change_skin(cls) {
    $.each(my_skins, function (i) {
      $("body").removeClass(my_skins[i]);
    });

    $("body").addClass(cls);
    store('skin', cls);
    return false;
  }

  /**
   * Store a new settings in the browser
   *
   * @param String name Name of the setting
   * @param String val Value of the setting
   * @returns void
   */
  function store(name, val) {
    if (typeof (Storage) !== "undefined") {
      localStorage.setItem(name, val);
    } else {
      window.alert('Please use a modern browser to properly view this template!');
    }
  }

  /**
   * Get a prestored setting
   *
   * @param String name Name of of the setting
   * @returns String The value of the setting | null
   */
  function get(name) {
    if (typeof (Storage) !== "undefined") {
      return localStorage.getItem(name);
    } else {
      window.alert('Please use a modern browser to properly view this template!');
    }
  }

  /**
   * Retrieve default settings and apply them to the template
   *
   * @returns void
   */
  function setup() {
    var tmp = get('skin');
    if (tmp && $.inArray(tmp, my_skins))
      change_skin(tmp);

    //Add the change skin listener
    $("[data-skin]").on('click', function (e) {
      if($(this).hasClass('knob'))
        return;
      e.preventDefault();
      change_skin($(this).data('skin'));
    });

    //Add the layout manager
    $("[data-layout]").on('click', function () {
      change_layout($(this).data('layout'));
    });

    $("[data-controlsidebar]").on('click', function () {
      change_layout($(this).data('controlsidebar'));
      var slide = !AdminLTE.options.controlSidebarOptions.slide;
      AdminLTE.options.controlSidebarOptions.slide = slide;
      if (!slide)
        $('.control-sidebar').removeClass('control-sidebar-open');
    });

    $("[data-sidebarskin='toggle']").on('click', function () {
      var sidebar = $(".control-sidebar");
      if (sidebar.hasClass("control-sidebar-dark")) {
        sidebar.removeClass("control-sidebar-dark")
        sidebar.addClass("control-sidebar-light")
      } else {
        sidebar.removeClass("control-sidebar-light")
        sidebar.addClass("control-sidebar-dark")
      }
    });

    $("[data-enable='expandOnHover']").on('click', function () {
      $(this).attr('disabled', true);
      AdminLTE.pushMenu.expandOnHover();
      if (!$('body').hasClass('sidebar-collapse'))
        $("[data-layout='sidebar-collapse']").click();
    });

    // Reset options
    if ($('body').hasClass('fixed')) {
      $("[data-layout='fixed']").attr('checked', 'checked');
    }
    if ($('body').hasClass('layout-boxed')) {
      $("[data-layout='layout-boxed']").attr('checked', 'checked');
    }
    if ($('body').hasClass('sidebar-collapse')) {
      $("[data-layout='sidebar-collapse']").attr('checked', 'checked');
    }

  }
})(jQuery, $.AdminLTE);
