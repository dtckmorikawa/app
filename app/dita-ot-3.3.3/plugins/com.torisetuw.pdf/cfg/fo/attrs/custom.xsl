<?xml version='1.0'?>

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:fo="http://www.w3.org/1999/XSL/Format"
    version="2.0">

<!--Layout-masters-attrs.xsl is in one above -->
<!--<xsl:import href="layout-masters-attr.xsl"/>-->

<!--For Look and Feel-->
    <xsl:import href="commons-attr.xsl"/>
    <xsl:import href="hi-domain-attr.xsl"/>
    <xsl:import href="task-elements-attr.xsl"/>
    <xsl:import href="markup-domain-attr.xsl"/>
    <xsl:import href="pr-domain-attr.xsl"/>
    <xsl:import href="sw-domain-attr.xsl"/>
    <xsl:import href="topic-attr.xsl"/>
    <xsl:import href="ui-domain-attr.xsl"/>
    <xsl:import href="xml-domain-attr.xsl"/>
    <xsl:import href="front-matter-attr.xsl"/>
<!--For Pagemasters-->
    <xsl:import href="basic-settings.xsl"/>
<!--Header and Footer-->
    <xsl:import href="static-content-attr.xsl"/>
<!--Tables-->
    <xsl:import href="tables-attr.xsl"/>
<!--Toc-->
    <xsl:import href="toc-attr.xsl"/>
<!--Watermark-->
    <xsl:import href="layout-masters-attr.xsl"/>

</xsl:stylesheet>