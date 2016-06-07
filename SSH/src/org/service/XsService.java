package org.service;

import org.model.XsbEntity;
import java.util.List;
/**
 * Created by wujiacheng on 16/6/5.
 */
public interface XsService {
    //插入学生
    public void save(XsbEntity xs);
    //根据学号删除学生
    public void delete(String xh);
    //修改学生信息
    public void update(XsbEntity xs);
    //根据学号查询学生信息
    public XsbEntity find(String xh);
    //分页显示学生信息
    public List findAll(int pageNow,int pageSize);
    //查询一共多少条学生记录
    public int findXsSize();

}
