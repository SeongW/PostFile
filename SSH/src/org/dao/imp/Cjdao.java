package org.dao.imp;

import org.model.CjbEntity;
import java.util.List;
/**
 * Created by wujiacheng on 16/6/5.
 */
public interface Cjdao {
    //插入学生成绩
    public void saveorupdateCj(CjbEntity cj);
    //根据学号和课程号删除学生成绩
    public void deleteCj(String xh,String kch);
    //根据学号和课程号查询学生成绩
    public CjbEntity getXsCj(String xh,String kch);
    //分页显示所有学生成绩
    public List findAllCj(int pageNow,int pageSize);
    //查询某学生成绩
    public List getXsCjList(String xh);
    //查询某们课程的学生成绩
    public List getKcCjList(String kch);
    //删除某学生的成绩
    public void deleteOneXsCj(String xh);
    //删除某门课程的成绩
    public void deleteOneKcInfo(String kch);
    //查询一共多少条成绩记录
    public int findCjSize();

}
