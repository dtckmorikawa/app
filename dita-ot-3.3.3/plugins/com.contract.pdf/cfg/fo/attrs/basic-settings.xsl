<?xml version="1.0" encoding="utf-8"?>
<!--
This file is part of the DITA Open Toolkit project.
See the accompanying LICENSE file for applicable license.
-->
<!-- (c) Copyright Suite Solutions -->
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                xmlns:xs="http://www.w3.org/2001/XMLSchema"
                version="2.0"
                exclude-result-prefixes="xs">

  <!-- Page Size is A4 -->
  <xsl:variable name="page-width">210mm</xsl:variable>
  <xsl:variable name="page-height">297mm</xsl:variable>

  <!-- Basic Font -->
  <xsl:variable name="default-font-size">10.6pt</xsl:variable>

  <!-- Mihiraki Settei -->
  <xsl:variable name="mirror-page-margins" select="true()"/>

  <!-- Change these if your page has different margins on different sides. -->
  <xsl:variable name="page-margin-inside">20mm</xsl:variable>
  <xsl:variable name="page-margin-outside">20mm</xsl:variable>
  <xsl:variable name="page-margin-top">22mm</xsl:variable>
  <xsl:variable name="page-margin-bottom">22mm</xsl:variable>

  <xsl:variable name="body-margin">28mm</xsl:variable>

  <!--front page-->
  <xsl:variable name="generate-front-cover" select="false()"/>
  
  <!-- first page -->
  <xsl:variable name="page-margin-top-first">50mm</xsl:variable>
  <xsl:variable name="haeder-extent-first">0mm</xsl:variable>

  <!--back cover generation-->
  <xsl:variable name="generate-back-cover" select="false()"/>

  <!--The side column width is the amount the body text is indented relative to the margin. -->
  <xsl:variable name="side-col-width">.5in</xsl:variable>

  <!-- General Line Height -->
  <xsl:variable name="default-line-height">130%</xsl:variable>

</xsl:stylesheet>
