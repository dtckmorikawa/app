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

  <!-- Mihiraki Settei -->
  <xsl:variable name="mirror-page-margins" select="true()"/>

  <!-- Change these if your page has different margins on different sides. -->
  <xsl:variable name="page-margin-inside">20mm</xsl:variable>
  <xsl:variable name="page-margin-outside">20mm</xsl:variable>
  <xsl:variable name="page-margin-top">22mm</xsl:variable>
  <xsl:variable name="page-margin-bottom">22mm</xsl:variable>

  <xsl:variable name="body-margin">28mm</xsl:variable>

  <!--front page-->
  <xsl:variable name="page-margin-outside-front">20mm</xsl:variable>
  <xsl:variable name="page-margin-top-front">20mm</xsl:variable>
  <xsl:variable name="page-margin-bottom-front">20mm</xsl:variable>

 <!-- first page -->
  <xsl:variable name="page-margin-top-first">50mm</xsl:variable>
  <xsl:variable name="header-extent-first">0mm</xsl:variable>

  <!--back cover generation-->
  <xsl:variable name="generate-back-cover" select="true()"/>

  <!--The side column width is the amount the body text is indented relative to the margin. -->
  <xsl:variable name="side-col-width">.5in</xsl:variable>

  <!-- Controlling MiniToc -->
  <xsl:variable name="chapterLayout" select="if (normalize-space($antArgsChapterLayout)) then $antArgsChapterLayout else 'BASIC'"/>

</xsl:stylesheet>
