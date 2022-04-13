<?xml version='1.0'?>

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:fo="http://www.w3.org/1999/XSL/Format"
    version="2.0">

    <xsl:import href="hi-domain.xsl"/>
    <!--<xsl:import href="lists.xsl"/>-->
    <xsl:import href="task-elements.xsl"/>
<!--Front page-->
    <xsl:import href="../layout-masters.xsl"/>
<!--header and footer-->
    <xsl:import href="root-processing.xsl"/>
    <xsl:import href="static-content.xsl"/>
    <xsl:import href="front-matter.xsl"/>

<!--Titles, body, text, and notes-->
    <xsl:import href="pr-domain.xsl"/>
    <xsl:import href="tables.xsl"/>

<!--Chapter number-->
    <xsl:import href="commons.xsl"/>
    <xsl:import href="topic.xsl"/>
    
<!--TOC-->
	<!--<xsl:import href="toc.xsl"/>-->
</xsl:stylesheet>