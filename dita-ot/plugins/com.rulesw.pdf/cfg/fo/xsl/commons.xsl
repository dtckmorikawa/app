<?xml version='1.0'?>

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:xs="http://www.w3.org/2001/XMLSchema"
    xmlns:fo="http://www.w3.org/1999/XSL/Format"
    xmlns:opentopic="http://www.idiominc.com/opentopic"
    xmlns:opentopic-index="http://www.idiominc.com/opentopic/index"
    xmlns:opentopic-func="http://www.idiominc.com/opentopic/exsl/function"
    xmlns:dita2xslfo="http://dita-ot.sourceforge.net/ns/200910/dita2xslfo"
    xmlns:dita-ot="http://dita-ot.sourceforge.net/ns/201007/dita-ot"
    xmlns:ot-placeholder="http://suite-sol.com/namespaces/ot-placeholder"
    xmlns:e="http://www.renderx.com/XSL/Extensions"
    exclude-result-prefixes="dita-ot ot-placeholder opentopic opentopic-index opentopic-func dita2xslfo xs"
    version="2.0">

    <xsl:template match="*[contains(@class, ' bookmap/chapter ')] |
                         opentopic:map/*[contains(@class, ' map/topicref ')]" mode="topicTitleNumber" priority="-1">
      <xsl:variable name="chapters">
        <xsl:document>
          <xsl:for-each select="$map/descendant::*[contains(@class, ' bookmap/chapter ')]">
            <xsl:sequence select="."/>
          </xsl:for-each>
        </xsl:document>
      </xsl:variable>
      <xsl:for-each select="$chapters/*[current()/@id = @id]">
        <xsl:number format="1" count="*[contains(@class, ' bookmap/chapter ')]"/>
      </xsl:for-each>
    </xsl:template>

<!--  Body Chapter processing  -->
   <xsl:template match="*" mode="insertChapterFirstpageStaticContent">
        <xsl:param name="type" as="xs:string"/>
        <fo:block>
            <xsl:attribute name="id">
                <xsl:call-template name="generate-toc-id"/>
            </xsl:attribute>
            <xsl:choose>
                <xsl:when test="$type = 'chapter'">
                    <fo:block xsl:use-attribute-sets="__chapter__frontmatter__name__container">
                        <xsl:value-of select="*[contains(@class, ' topic/title ')]"/>
                        <!-- To show chapter numbers, use the code below
                        <xsl:call-template name="getVariable">
                            <xsl:with-param name="id" select="'Chapter with number'"/>
                            <xsl:with-param name="params">
                                <number>
                                    <fo:inline xsl:use-attribute-sets="__chapter__frontmatter__number__container">
                                        <xsl:apply-templates select="key('map-id', @id)[1]" mode="topicTitleNumber"/>
                                    </fo:inline>
                                    <xsl:text>章 </xsl:text>
                                    <fo:inline xsl:use-attribute-sets="chapter.title">
                                      <xsl:value-of select="*[contains(@class, ' topic/title ')]"/>
                                    </fo:inline>
                                </number>
                            </xsl:with-param>
                        </xsl:call-template>-->
                    </fo:block>
                </xsl:when>
                <xsl:when test="$type = 'appendix'">
                        <fo:block xsl:use-attribute-sets="__chapter__frontmatter__name__container">
                            <xsl:call-template name="getVariable">
                                <xsl:with-param name="id" select="'Appendix with number'"/>
                                <xsl:with-param name="params">
                                    <number>
                                        <fo:inline xsl:use-attribute-sets="__chapter__frontmatter__number__container">
                                            <xsl:apply-templates select="key('map-id', @id)[1]" mode="topicTitleNumber"/>
                                        </fo:inline>
                                        <xsl:text> </xsl:text>
                                        <fo:inline xsl:use-attribute-sets="topic.title">
                                          <xsl:value-of select="*[contains(@class, ' topic/title ')]"/>
                                        </fo:inline>
                                    </number>
                                </xsl:with-param>
                            </xsl:call-template>
                        </fo:block>
                </xsl:when>
              <xsl:when test="$type = 'appendices'">
                <fo:block xsl:use-attribute-sets="__chapter__frontmatter__name__container">
                  <xsl:call-template name="getVariable">
                    <xsl:with-param name="id" select="'Appendix with number'"/>
                    <xsl:with-param name="params">
                      <number>
                        <fo:inline xsl:use-attribute-sets="__chapter__frontmatter__number__container">
                          <xsl:text>&#xA0;</xsl:text>
                        </fo:inline>
                      </number>
                    </xsl:with-param>
                  </xsl:call-template>
                </fo:block>
              </xsl:when>
                <xsl:when test="$type = 'part'">
                        <fo:block xsl:use-attribute-sets="__chapter__frontmatter__name__container">
                            <xsl:call-template name="getVariable">
                                <xsl:with-param name="id" select="'Part with number'"/>
                                <xsl:with-param name="params">
                                    <number>
                                        <fo:inline xsl:use-attribute-sets="__chapter__frontmatter__number__container">
                                            <xsl:apply-templates select="key('map-id', @id)[1]" mode="topicTitleNumber"/>
                                        </fo:inline>
                                        <xsl:text> </xsl:text>
                                        <fo:inline xsl:use-attribute-sets="topic.title">
                                          <xsl:value-of select="*[contains(@class, ' topic/title ')]"/>
                                        </fo:inline>
                                    </number>
                                </xsl:with-param>
                            </xsl:call-template>
                        </fo:block>
                </xsl:when>
                <xsl:when test="$type = 'preface'">
                        <fo:block xsl:use-attribute-sets="__chapter__frontmatter__name__container">
                            <xsl:call-template name="getVariable">
                                <xsl:with-param name="id" select="'Preface title'"/>
                            </xsl:call-template>
                        </fo:block>
                </xsl:when>
                <xsl:when test="$type = 'notices'">
                        <fo:block xsl:use-attribute-sets="__chapter__frontmatter__name__container">
                            <xsl:call-template name="getVariable">
                                <xsl:with-param name="id" select="'Notices title'"/>
                            </xsl:call-template>
                        </fo:block>
                </xsl:when>
            </xsl:choose>
        </fo:block>
    </xsl:template>

    <!--  Bookmap Chapter processing  -->
    <xsl:template name="processTopicChapter">
        <xsl:variable name="expectedChapterContext" as="xs:boolean">
            <xsl:choose>
                <xsl:when test="empty(parent::*[contains(@class,' topic/topic ')])"><xsl:sequence select="true()"/></xsl:when>
                <xsl:when test="count(ancestor::*[contains(@class,' topic/topic ')]) = 1 and 
                    contains((key('map-id',parent::*/@id)[1])/@class,' bookmap/part ')"><xsl:sequence select="true()"/></xsl:when>
                <xsl:otherwise><xsl:sequence select="false()"/></xsl:otherwise>
            </xsl:choose>
        </xsl:variable>
        <xsl:choose>
            <xsl:when test="$expectedChapterContext">
                <fo:page-sequence master-reference="body-sequence" xsl:use-attribute-sets="page-sequence.body">
                    <xsl:call-template name="startPageNumbering"/>
                    <xsl:call-template name="insertBodyStaticContents"/>
                    <fo:flow flow-name="xsl-region-body">
                        <xsl:apply-templates select="." mode="processTopicChapterInsideFlow"/>
                    </fo:flow>
                </fo:page-sequence>
            </xsl:when>
            <xsl:otherwise>
                <xsl:apply-templates select="." mode="processTopicChapterInsideFlow"/>
            </xsl:otherwise>
        </xsl:choose>
    </xsl:template>
    <xsl:template match="*" mode="processTopicChapterInsideFlow">
        <fo:block xsl:use-attribute-sets="topic">
            <xsl:call-template name="commonattributes"/>
            <xsl:variable name="level" as="xs:integer">
              <xsl:apply-templates select="." mode="get-topic-level"/>
            </xsl:variable>
            <xsl:if test="$level eq 1">
                <fo:marker marker-class-name="current-topic-number">
                  <xsl:variable name="topicref" 
                    select="key('map-id', ancestor-or-self::*[contains(@class, ' topic/topic ')][1]/@id)[1]" 
                    as="element()?"/>
                  <xsl:for-each select="$topicref">
                    <xsl:apply-templates select="." mode="topicTitleNumber"/>
                  </xsl:for-each>
                </fo:marker>
                <xsl:apply-templates select="." mode="insertTopicHeaderMarker"/>
            </xsl:if>
            <xsl:apply-templates select="." mode="customTopicMarker"/>

            <xsl:apply-templates select="*[contains(@class,' topic/prolog ')]"/>

            <xsl:apply-templates select="." mode="insertChapterFirstpageStaticContent">
                <xsl:with-param name="type" select="'chapter'"/>
            </xsl:apply-templates>

            <fo:block xsl:use-attribute-sets="topic.title.hide">
                <xsl:apply-templates select="." mode="customTopicAnchor"/>
                <xsl:call-template name="pullPrologIndexTerms"/>
                <xsl:apply-templates select="*[contains(@class,' ditaot-d/ditaval-startprop ')]"/>
                <xsl:for-each select="*[contains(@class,' topic/title ')]">
                    <xsl:apply-templates select="." mode="getTitle"/>
                </xsl:for-each>
            </fo:block>

            <xsl:choose>
              <xsl:when test="$chapterLayout='BASIC'">
                  <xsl:apply-templates select="* except(*[contains(@class, ' topic/title ') or contains(@class,' ditaot-d/ditaval-startprop ') or
                      contains(@class, ' topic/prolog ') or contains(@class, ' topic/topic ')])"/>
                  <!--xsl:apply-templates select="." mode="buildRelationships"/-->
              </xsl:when>
              <xsl:otherwise>
                  <xsl:apply-templates select="." mode="createMiniToc"/>
              </xsl:otherwise>
            </xsl:choose>

            <xsl:apply-templates select="*[contains(@class,' topic/topic ')]"/>
            <xsl:call-template name="pullPrologIndexTerms.end-range"/>
        </fo:block>
    </xsl:template>

    <!--  Bookmap Appendix processing  -->
    <xsl:template name="processTopicAppendix">
        <xsl:variable name="expectedAppContext" as="xs:boolean">
            <xsl:choose>
                <xsl:when test="empty(parent::*[contains(@class,' topic/topic ')])"><xsl:sequence select="true()"/></xsl:when>
                <xsl:when test="count(ancestor::*[contains(@class,' topic/topic ')]) = 1 and 
                    contains(key('map-id',parent::*/@id)[1]/@class,' bookmap/appendices ')"><xsl:sequence select="true()"/></xsl:when>
                <xsl:otherwise><xsl:sequence select="false()"/></xsl:otherwise>
            </xsl:choose>
        </xsl:variable>
        <xsl:choose>
            <xsl:when test="$expectedAppContext">
                <fo:page-sequence master-reference="body-sequence" xsl:use-attribute-sets="page-sequence.appendix">
                    <xsl:call-template name="startPageNumbering"/>
                    <xsl:call-template name="insertBodyStaticContents"/>
                    <fo:flow flow-name="xsl-region-body">
                        <xsl:apply-templates select="." mode="processTopicAppendixInsideFlow"/>
                    </fo:flow>
                </fo:page-sequence>
            </xsl:when>
            <xsl:otherwise>
                <xsl:apply-templates select="." mode="processTopicAppendixInsideFlow"/>
            </xsl:otherwise>
        </xsl:choose>
    </xsl:template>
    <xsl:template match="*" mode="processTopicAppendixInsideFlow">
        <fo:block xsl:use-attribute-sets="topic">
            <xsl:call-template name="commonattributes"/>
            <xsl:variable name="level" as="xs:integer">
              <xsl:apply-templates select="." mode="get-topic-level"/>
            </xsl:variable>
            <xsl:if test="$level eq 1">
                <fo:marker marker-class-name="current-topic-number">
                  <xsl:variable name="topicref" 
                    select="key('map-id', ancestor-or-self::*[contains(@class, ' topic/topic ')][1]/@id)[1]" 
                    as="element()?"/>
                    <xsl:for-each select="$topicref">
                      <xsl:apply-templates select="." mode="topicTitleNumber"/>
                    </xsl:for-each>
                </fo:marker>
                <xsl:apply-templates select="." mode="insertTopicHeaderMarker"/>
            </xsl:if>
            <xsl:apply-templates select="." mode="customTopicMarker"/>

            <xsl:apply-templates select="*[contains(@class,' topic/prolog ')]"/>

            <xsl:apply-templates select="." mode="insertChapterFirstpageStaticContent">
                <xsl:with-param name="type" select="'appendix'"/>
            </xsl:apply-templates>

            <fo:block xsl:use-attribute-sets="topic.title.hide">
                <xsl:apply-templates select="." mode="customTopicAnchor"/>
                <xsl:apply-templates select="*[contains(@class,' ditaot-d/ditaval-startprop ')]"/>
                <xsl:call-template name="pullPrologIndexTerms"/>
                <xsl:for-each select="*[contains(@class,' topic/title ')]">
                    <xsl:apply-templates select="." mode="getTitle"/>
                </xsl:for-each>
            </fo:block>

            <xsl:choose>
              <xsl:when test="$appendixLayout='BASIC'">
                  <xsl:apply-templates select="* except(*[contains(@class, ' topic/title ') or contains(@class,' ditaot-d/ditaval-startprop ') or
                      contains(@class, ' topic/prolog ') or contains(@class, ' topic/topic ')])"/>
                  <!--xsl:apply-templates select="." mode="buildRelationships"/-->
              </xsl:when>
              <xsl:otherwise>
                  <xsl:apply-templates select="." mode="createMiniToc"/>
              </xsl:otherwise>
            </xsl:choose>

            <xsl:apply-templates select="*[contains(@class,' topic/topic ')]"/>
            <xsl:call-template name="pullPrologIndexTerms.end-range"/>
        </fo:block>
    </xsl:template>

    <!--  Bookmap Part processing  -->
    <xsl:template name="processTopicPart">
        <xsl:variable name="expectedPartContext" as="xs:boolean" 
            select="empty(parent::*[contains(@class,' topic/topic ')])"/>
        <xsl:choose>
            <xsl:when test="$expectedPartContext">
                <fo:page-sequence master-reference="body-sequence" xsl:use-attribute-sets="page-sequence.part">
                    <xsl:call-template name="startPageNumbering"/>
                    <xsl:call-template name="insertBodyStaticContents"/>
                    <fo:flow flow-name="xsl-region-body">
                        <xsl:apply-templates select="." mode="processTopicPartInsideFlow"/>
                    </fo:flow>
                </fo:page-sequence>
            </xsl:when>
            <xsl:otherwise>
                <xsl:apply-templates select="." mode="processTopicPartInsideFlow"/>
            </xsl:otherwise>
        </xsl:choose>
        <xsl:for-each select="*[contains(@class,' topic/topic ')]">
            <xsl:variable name="topicType" as="xs:string">
                <xsl:call-template name="determineTopicType"/>
            </xsl:variable>
            <xsl:if test="not($topicType = 'topicSimple')">
                <xsl:apply-templates select="."/>
            </xsl:if>
        </xsl:for-each>
    </xsl:template>
    <xsl:template match="*" mode="processTopicPartInsideFlow">
        <fo:block xsl:use-attribute-sets="topic">
            <xsl:call-template name="commonattributes"/>
            <xsl:if test="empty(ancestor::*[contains(@class, ' topic/topic ')])">
                <fo:marker marker-class-name="current-topic-number">
                  <xsl:variable name="topicref" 
                    select="key('map-id', ancestor-or-self::*[contains(@class, ' topic/topic ')][1]/@id)[1]" 
                    as="element()?"
                  />
                  <xsl:for-each select="$topicref">
                    <xsl:apply-templates select="." mode="topicTitleNumber"/>
                  </xsl:for-each>
                </fo:marker>
                <xsl:apply-templates select="." mode="insertTopicHeaderMarker"/>
            </xsl:if>
            <xsl:apply-templates select="." mode="customTopicMarker"/>

            <xsl:apply-templates select="*[contains(@class,' topic/prolog ')]"/>

            <xsl:apply-templates select="." mode="insertChapterFirstpageStaticContent">
                <xsl:with-param name="type" select="'part'"/>
            </xsl:apply-templates>

            <fo:block xsl:use-attribute-sets="topic.title.hide">
                <xsl:apply-templates select="." mode="customTopicAnchor"/>
                <xsl:call-template name="pullPrologIndexTerms"/>
                <xsl:apply-templates select="*[contains(@class,' ditaot-d/ditaval-startprop ')]"/>
                <xsl:for-each select="*[contains(@class,' topic/title ')]">
                    <xsl:apply-templates select="." mode="getTitle"/>
                </xsl:for-each>
            </fo:block>

            <xsl:choose>
              <xsl:when test="$partLayout='BASIC'">
                  <xsl:apply-templates select="* except(*[contains(@class, ' topic/title ') or contains(@class,' ditaot-d/ditaval-startprop ') or
                      contains(@class, ' topic/prolog ') or contains(@class, ' topic/topic ')])"/>
                  <!--xsl:apply-templates select="." mode="buildRelationships"/-->
              </xsl:when>
              <xsl:otherwise>
                  <xsl:apply-templates select="." mode="createMiniToc"/>
              </xsl:otherwise>
            </xsl:choose>
            <xsl:for-each select="*[contains(@class,' topic/topic ')]">
                <xsl:variable name="topicType" as="xs:string">
                    <xsl:call-template name="determineTopicType"/>
                </xsl:variable>
                <xsl:if test="$topicType = 'topicSimple'">
                    <xsl:apply-templates select="."/>
                </xsl:if>
            </xsl:for-each>
            <xsl:call-template name="pullPrologIndexTerms.end-range"/>
        </fo:block>
    </xsl:template>
   
</xsl:stylesheet>
